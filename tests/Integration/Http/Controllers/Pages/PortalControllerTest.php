<?php

namespace Tests\Integration\Http\Controllers\Pages;

use App\Http\Controllers\Pages\PortalController;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Contracts\Repository as ActivityRepository;
use BristolSU\Support\Logic\Contracts\LogicTester;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Prophecy\Argument;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class PortalControllerTest extends TestCase
{

    public function loadPortal($participant = [], $administrator = [])
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $activityRepository = $this->prophesize(ActivityRepository::class);
        $activityRepository->getForParticipant()->willReturn(Arr::wrap($participant));
        $activityRepository->getForAdministrator()->willReturn(Arr::wrap($administrator));
        $this->instance(ActivityRepository::class, $activityRepository->reveal());

        return $this->get('/portal');
    }

    /** @test */
    public function it_throws_an_error_if_no_activities_are_found(){

        $response = $this->loadPortal();
        $response->assertStatus(404);
        $this->assertEquals('You have no activities!', $response->exception->getMessage());

    }

    /** @test */
    public function it_redirects_to_a_participant_activity_if_owned(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadPortal([$activity]);
        $response->assertRedirect('/'.$activity->slug);
    }

    /** @test */
    public function it_redirects_to_an_administrator_activity_if_owned(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadPortal([], [$activity]);
        $response->assertRedirect('/'.$activity->slug);
    }

    /** @test */
    public function it_redirects_to_a_participant_activity_over_an_administrator_activity(){
        $activity1 = factory(Activity::class)->create();
        $activity2 = factory(Activity::class)->create();
        $response = $this->loadPortal([$activity1], [$activity2]);
        $response->assertRedirect('/'.$activity1->slug);
    }

    /** @test */
    public function it_redirects_to_the_first_participant_activity(){
        $activity1 = factory(Activity::class)->create();
        $activity2 = factory(Activity::class)->create();
        $response = $this->loadPortal([$activity1, $activity2]);
        $response->assertRedirect('/'.$activity1->slug);
    }

    /** @test */
    public function it_redirects_to_the_first_admin_activity(){
        $activity1 = factory(Activity::class)->create();
        $activity2 = factory(Activity::class)->create();
        $response = $this->loadPortal([], [$activity1, $activity2]);
        $response->assertRedirect('/'.$activity1->slug);
    }

}
