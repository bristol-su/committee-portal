<?php

namespace App\Http\Controllers;

use Twigger\UnionCloud\API\UnionCloud;
use Illuminate\Http\Request;

class UnionCloudController extends Controller
{
    public function getUserByUID(Request $request, UnionCloud $unionCloud)
    {
        $request->validate([
            'uid' => 'required'
        ]);

        $user = $unionCloud->users()->getByUID($request->get('uid'))->get()->first();

        return [
            'uid' => $user->uid,
            'id' => $user->id,
            'forename' => $user->forename,
            'surname' => $user->surname,
            'email' => $user->email
        ];

    }

    public function searchOneTerm(Request $request, UnionCloud $unionCloud)
    {

        $request->validate([
            'search' => 'required'
        ]);

        // Search UnionCloud
        try {
            $usersById = collect($unionCloud->users()->search(['id' => $request->get('search')])->get()->toArray());
        } catch (\Exception $e) {
            $usersById = new \Illuminate\Support\Collection();
        }

        try {
            $usersByEmail = collect($unionCloud->users()->setMode('basic')->search(['email' => $request->get('search')])->get()->toArray());
        } catch (\Exception $e) {
            $usersByEmail = new \Illuminate\Support\Collection();
        }

        $users = collect(array_merge($usersById->all(), $usersByEmail->all()));

        // TODO Gets the attributes of a UnionCloud model
        $attributes = new \Illuminate\Support\Collection();
        foreach($users as $user) {
            $attributes->push($user->getAttributes());
        }

        abort_if($attributes->count() === 0, 404);

        // map acts as an 'only' function
        return $attributes->unique()->sortBy('forename')->map(function($user) {
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
        })->values()->toJson();
    }

}
