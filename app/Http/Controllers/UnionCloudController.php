<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Twigger\UnionCloud\API\UnionCloud;
use Illuminate\Http\Request;

class UnionCloudController extends Controller
{
    /**
     * Minutes for which a result will be in the cache.
     *
     * @var int
     */
    protected $cacheRemember = 10000;

    public function getUserByUID(Request $request, UnionCloud $unionCloud)
    {
        $request->validate([
            'uid' => 'required'
        ]);

        $uid = $request->get('uid');

        return Cache::remember('UnionCloudController.getUserByUID.'.$uid, $this->cacheRemember, function() use ($uid, $unionCloud) {
            $user = $unionCloud->users()->getByUID($uid)->get()->first();

            return [
                'uid' => $user->uid,
                'id' => $user->id,
                'forename' => $user->forename,
                'surname' => $user->surname,
                'email' => $user->email
            ];
        });


    }

    public function searchOneTerm(Request $request, UnionCloud $unionCloud)
    {

        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->get('search');

        // Get by User ID
        try {
            $usersById = collect($unionCloud->users()->search(['id' => $search])->get()->toArray());
        } catch (\Exception $e) {
            $usersById = new \Illuminate\Support\Collection();
        }

        // Get by Email
        try {
            $usersByEmail = collect($unionCloud->users()->setMode('basic')->search(['email' => $search])->get()->toArray());
        } catch (\Exception $e) {
            $usersByEmail = new \Illuminate\Support\Collection();
        }

        // Bundle into a single collection
        $users = collect(array_merge($usersById->all(), $usersByEmail->all()));

        // Gets the attributes of the User classes
        // TODO Clean up
        $attributes = new \Illuminate\Support\Collection();
        foreach($users as $user) {
            $attributes->push($user->getAttributes());
        }

        abort_if($attributes->count() === 0, 404);

        // map acts as an 'only' function
        return Cache::remember('UnionCloudController.searchOneTerm.'.$search, $this->cacheRemember, function() use ($attributes) {
            return $attributes->map(function($user) {
                $filteredAttributes = [
                    'uid' => '',
                    'id' => '',
                    'forename' => '',
                    'surname' => '',
                    'email' => ''
                ];
                foreach($filteredAttributes as $attribute => $key) {
                    $filteredAttributes[$attribute] = (isset($user[$attribute])?$user[$attribute]:'');
                }
                return $filteredAttributes;
            })->unique()->sortBy('forename')->values()->toJson();
        });
    }

}
