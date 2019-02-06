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

        if(Auth::check())
        {
            try {
                $positions = $this->getPositions();
            } catch(\Exception $e)
            {
                if($e->getCode() === 404)
                {
                    return response('Your student account wasn\'t found in our records.', 404);
                } elseif($e instanceof StudentHasNoPositions)
                {
                    return response($e->getMessage());
                }
                return abort(500, 'Sorry, we couldn\'t log you in!');
            }

            if($positions instanceof \Exception)
            {
                throw $positions;
            }
            // Set the positions in the user model
            Auth::user()->setPositions($positions);
        }

        return $next($request);
    }

    private function getPositions()
    {
        // Get the positions of a user
        $user = Auth::user();

        // Get the positions if necessary
        $positions = $user->getPositionsForUser();

        $formattedPositions = $this->formatPositions($positions);

        return $formattedPositions;



    }

    /**
     * @param array $positions May be positions or groups. If $isAdmin is true,
     * it's just groups.
     * @return array
     */
    private function formatPositions($positions)
    {
        $isAdmin = Auth::user()->isAdmin();
        $userPositions = [];
        foreach($positions as $position)
        {
            $userPositions[] = [
                'position_id' => ($isAdmin?null:$position->id),
                'group_id' => ($isAdmin?$position->id:$position->pivot->group_id),
                'position_name' => ($isAdmin?'Admin':$position->name),
                'group_name' => ($isAdmin?$position->name:$this->getGroupNameByID($position->pivot->group_id))
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
