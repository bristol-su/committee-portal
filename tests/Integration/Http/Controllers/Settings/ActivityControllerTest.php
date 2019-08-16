<?php


namespace Tests\Integration\Http\Controllers\Settings;


use App\Support\Activity\Activity;
use App\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use App\Support\Activity\Repository;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{

    /** @test */
    public function index_loads_the_correct_view(){
        $response = $this->get('/settings/activity');
        $response->assertViewIs('settings.activity.index');
    }

    /** @test */
    public function index_passes_all_activities_from_the_repository_into_the_view(){
        $activities = factory(Activity::class, 10)->create();
        $activityRepo = $this->prophesize(ActivityRepositoryContract::class);
        $activityRepo->all()->shouldBeCalled()->willReturn($activities);
        $this->instance(ActivityRepositoryContract::class, $activityRepo->reveal());

        $response = $this->get('/settings/activity');
        foreach($response->original->gatherData()['activities'] as $activity){
            $this->assertModelEquals($activity, $activities->shift());
        }
    }

    /** @test */
    public function show_loads_the_correct_view(){
        $activity = factory(Activity::class)->create();
        $response = $this->get('/settings/activity/'.$activity->id);
        $response->assertViewIs('settings.activity.show');
    }

    /** @test */
    public function show_passes_the_correct_activity_to_the_view(){
        $activity = factory(Activity::class)->create();

        $response = $this->get('/settings/activity/' . $activity->id);
        $this->assertModelEquals($activity, $response->original->gatherData()['activity']);
    }

}
