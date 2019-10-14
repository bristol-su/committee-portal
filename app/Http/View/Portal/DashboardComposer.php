<?php


namespace App\Http\View\Portal;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepository;
use BristolSU\Support\Authentication\Contracts\Authentication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardComposer
{

    /**
     * @var ActivityRepository
     */
    private $activityRepository;
    /**
     * @var Activity
     */
    private $activity;
    /**
     * @var Authentication
     */
    private $authentication;
    /**
     * @var Request
     */
    private $request;

    public function __construct(ActivityRepository $activityRepository, Activity $activity, Authentication $authentication, Request $request)
    {
        $this->activityRepository = $activityRepository;
        $this->activity = $activity;
        $this->authentication = $authentication;
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $user = null;
        $group = null;
        $role = null;
        if($this->activity->activity_for === 'user') {
            $user = $this->authentication->getUser();
        } elseif($this->activity->activity_for === 'group') {
            $group = $this->authentication->getGroup();
        } elseif($this->activity->activity_for === 'role') {
            $role = $this->authentication->getRole();
        }
        if($this->request->route()->getName() === 'administrator' || $this->request->route()->getName() === 'administrator.activity') {
            $view->with('activities', $this->activityRepository->getForAdministrator($user, $group, $role));
        } elseif($this->request->route()->getName() === 'participant' || $this->request->route()->getName() === 'participant.activity') {
            $view->with('activities', $this->activityRepository->getForParticipant($user, $group, $role));
        }
    }

}
