<?php


namespace App\Http\View\Portal;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepository;
use BristolSU\Support\Authentication\Contracts\Authentication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ActivitySidebarComposer
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

    /**
     * Gather activities in the sidebar
     *
     * The sidebar should contain activities which are accessible to you in your current auth state
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        // TODO What should the sidebar actually contain?
        $user = null;
        $group = null;
        $role = null;
        if($this->activity->activity_for === 'user') {
            $user = $this->authentication->getUser();
        } elseif($this->activity->activity_for === 'group') {
            $user = $this->authentication->getUser();
            $group = $this->authentication->getGroup();
        } elseif($this->activity->activity_for === 'role') {
            $user = $this->authentication->getUser();
            $group = $this->authentication->getGroup();
            $role = $this->authentication->getRole();
        }
        if($this->request->is('a/*')) {
            $view->with('activities', $this->activityRepository->getForAdministrator($user, $group, $role));
        } elseif($this->request->is('p/*')) {
            $view->with('activities', $this->activityRepository->getForParticipant($user, $group, $role));
        }
    }

}
