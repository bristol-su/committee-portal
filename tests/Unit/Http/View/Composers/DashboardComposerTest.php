<?php


namespace Tests\Unit\Http\View\Composers;


use App\Http\View\Composers\DashboardComposer;
use App\Support\Activity\Contracts\Repository as ActivityRepository;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

class DashboardComposerTest extends TestCase
{

    /** @test */
    public function compose_adds_admin_activities_to_the_view(){
        $activityRepository = $this->prophesize(ActivityRepository::class);
        $activityRepository->getForAdministrator()->shouldBeCalled()->willReturn('something');
        $activityRepository->getForParticipant()->shouldBeCalled()->willReturn('something');

        $view = $this->prophesize(View::class);
        $view->with('administratorActivities', 'something')->shouldBeCalled();
        $view->with('participantActivities', 'something')->shouldBeCalled();

        $composer = new DashboardComposer($activityRepository->reveal());
        $composer->compose($view->reveal());
    }

}
