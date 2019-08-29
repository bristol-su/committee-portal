<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Activity\Activity;
use App\Support\Activity\Contracts\Repository;
use App\Support\Logic\Logic;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{

    /** @test */
    public function store_calls_create_on_the_activity_repository(){
        $parameters = [
            'name' => 'A Name',
            'description' => 'Some Description',
            'slug' => 'a-name',
            'activity_for' => 'user',
            'for_logic' => factory(Logic::class)->create()->id,
            'admin_logic' => factory(Logic::class)->create()->id,
            'start_date' => '2019-12-20 12:00:00',
            'end_date' => '2019-12-20 13:00:00'
        ];

        $activityRepository = $this->prophesize(Repository::class);
        $activityRepository->create($parameters)->shouldBeCalled()->willReturn(Activity::create($parameters));
        $this->instance(Repository::class, $activityRepository->reveal());

        $response = $this->json('post', '/api/activity', $parameters);
        $response->assertStatus(201);
    }

    /** @test */
    public function store_stores_an_activity_in_the_database(){
        $parameters = [
            'name' => 'A Name',
            'description' => 'Some Description',
            'slug' => 'a-name',
            'activity_for' => 'user',
            'for_logic' => factory(Logic::class)->create()->id,
            'admin_logic' => factory(Logic::class)->create()->id,
            'start_date' => '2019-12-20 12:00:00',
            'end_date' => '2019-12-20 13:00:00'
        ];

        $response = $this->json('post', '/api/activity', $parameters);
        $response->assertStatus(201);
        $this->assertDatabaseHas('activities', $parameters);

    }

}
