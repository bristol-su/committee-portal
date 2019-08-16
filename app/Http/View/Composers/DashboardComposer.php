<?php


namespace App\Http\View\Composers;


use App\Support\Activity\Contracts\Repository as ActivityRepository;
use Illuminate\Contracts\View\View;

class DashboardComposer
{

    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {

        $this->activityRepository = $activityRepository;
    }

    public function compose(View $view)
    {
        $view->with('administratorActivities', $this->activityRepository->getForAdministrator());
        $view->with('participantActivities', $this->activityRepository->getForParticipant());
    }

}
