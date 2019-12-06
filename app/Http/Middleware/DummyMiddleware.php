<?php

namespace App\Http\Middleware;

use BristolSU\Support\Authentication\Contracts\UserAuthentication;
use BristolSU\Support\Permissions\Models\ModelPermission;
use Illuminate\Http\Request;

class DummyMiddleware
{

    public function handle(Request $request, $next)
    {
        $userId = app(UserAuthentication::class)->getUser()->control_id;
        // Give permissions to the user if they don't already have them
        // This is JUST for the demo site purpose
        ModelPermission::firstOrCreate([
            'ability' => 'show-activities', 'model' => 'user', 'model_id' => $userId
        ], ['result' => true]);
        ModelPermission::firstOrCreate([
            'ability' => 'create-activities', 'model' => 'user', 'model_id' => $userId
        ], ['result' => true]);
        ModelPermission::firstOrCreate([
            'ability' => 'index-activities', 'model' => 'user', 'model_id' => $userId
        ], ['result' => true]);
        ModelPermission::firstOrCreate([
            'ability' => 'view-settings', 'model' => 'user', 'model_id' => $userId
        ], ['result' => true]);
        return $next($request);
    }

}
