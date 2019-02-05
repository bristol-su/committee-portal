<?php

namespace App\Http\Middleware;

use App\Exceptions\StudentHasNoPositions;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class LogIntoPositionFromControl
{
    /**
     *
     * Ensure the user is logged in as a current position
     * in a society.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
//        Gate::after(function ($user, $ability, $result, $arguments) {
//            return true;
//        });
        // Get the positions from the Control Database or Cache
        $positions = $this->getPositions();

        if($positions instanceof \Exception)
        {
            throw $positions;
        }
        // Set the positions in the user model
        Auth::user()->setPositions($positions);

        return $next($request);
    }

    private function getPositions()
    {
        // Get the positions of a user
        $user = Auth::user();

        // Get the positions if necessary
        if( ! Cache::has('authentication:userpositions.'.$user->id))
        {
            try {
                $positions = $user->getPositionsForUser();
            } catch(\Exception $e)
            {
                if($e->getCode() === 404)
                {
                    return response('Your student account wasn\'t found in our records.', 404);
                } elseif($e instanceof StudentHasNoPositions)
                {
                    return response($e->getMessage());
                }
                return response('Sorry, we couldn\'t log you in!', 500);
            }

            $formattedPositions = $this->formatPositions($positions);
            Cache::put('authentication:userpositions.'.$user->id, $formattedPositions, 5);

            return $formattedPositions;
        }


        return Cache::get('authentication:userpositions.'.$user->id);

    }

    private function formatPositions($positions)
    {
        $userPositions = [];
        foreach($positions as $position)
        {
            $userPositions[] = [
                'position_id' => $position->id,
                'group_id' => $position->pivot->group_id,
                'position_name' => $position->name,
                'group_name' => $this->getGroupNameByID($position->pivot->group_id)
            ];
        }
        return $userPositions;
    }

    private function getGroupNameByID($id)
    {
        $controlDB = resolve('App\Packages\ControlDB\ControlDBInterface');
        $group = $controlDB->getGroupByID($id);
        return $group->name;
    }

}
