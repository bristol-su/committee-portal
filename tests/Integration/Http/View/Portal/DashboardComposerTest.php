<?php

namespace Tests\Integration\Http\View\Portal;

use App\Http\View\Portal\DashboardComposer;
use BristolSU\Support\Activity\Contracts\Repository;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

class DashboardComposerTest extends TestCase
{

    /** @test */
    public function compose_adds_admin_and_participant_activities_to_the_view(){
        $activityRepository = $this->prophesize(Repository::class);
        $activityRepository->getForAdministrator()->shouldBeCalled()->willReturn('admin');
        $activityRepository->getForParticipant()->shouldBeCalled()->willReturn('participant');

        $view = $this->prophesize(View::class);
        $view->with('administratorActivities', 'admin')->shouldBeCalled();
        $view->with('participantActivities', 'participant')->shouldBeCalled();

        $composer = new DashboardComposer($activityRepository->reveal());
        $composer->compose($view->reveal());
    }

}
