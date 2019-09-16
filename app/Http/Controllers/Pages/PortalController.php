<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use BristolSU\Support\Logic\Facade\LogicTester;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PortalController extends Controller
{

    public function portal(Request $request, ActivityRepositoryContract $activityRepository)
    {
        $userActivities = collect($activityRepository->getForParticipant());
        if($userActivities->count() > 0) {
            return Response::redirectTo('a/' . $userActivities->first()->slug);
        }
        $adminActivities = collect($activityRepository->getForAdministrator());
        if($adminActivities->count() > 0) {
            return Response::redirectTo('a/' . $adminActivities->first()->slug);
        }

        throw new HttpException(404, 'You have no activities!');
    }

}

