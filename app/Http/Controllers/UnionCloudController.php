<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Twigger\UnionCloud\API\UnionCloud;

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

        return Cache::remember('App.Http.Controllers.UnionCloudController.getUserByUID.'.$uid, $this->cacheRemember, function() use ($uid, $unionCloud) {
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
            $usersById = Cache::remember('App.Http.Controllers.UnionCloudController.searchOneTerm.searchByID.'.$search, $this->cacheRemember, function() use ($search, $unionCloud) {
                return collect($unionCloud->users()->search(['id' => $search])->get()->toArray());
            });

        } catch (\Exception $e) {
            $usersById = new \Illuminate\Support\Collection();
        }

        // Get by Email
        try {
            $usersByEmail = Cache::remember('App.Http.Controllers.UnionCloudController.searchOneTerm.searchByEmail.'.$search, $this->cacheRemember, function() use ($search, $unionCloud) {
                return collect($unionCloud->users()->search(['email' => $search])->get()->toArray());
            });
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
        return $attributes->map(function ($user) {
            $filteredAttributes = [
                'uid' => '',
                'id' => '',
                'forename' => '',
                'surname' => '',
                'email' => ''
            ];
            foreach ($filteredAttributes as $attribute => $key) {
                $filteredAttributes[$attribute] = (isset($user[$attribute]) ? $user[$attribute] : '');
            }
            return $filteredAttributes;
        })->unique()->sortBy('forename')->values()->toJson();
    }



}
