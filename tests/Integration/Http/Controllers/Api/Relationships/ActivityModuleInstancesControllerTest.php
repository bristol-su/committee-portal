<?php


namespace Tests\Integration\Http\Controllers\Api\Relationships;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ModuleInstance\ModuleInstance;
use BristolSU\Support\User\User;
use Tests\TestCase;

class ActivityModuleInstancesControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }

    /** @test */
    public function index_returns_404_if_activity_not_found(){
        $response = $this->json('get', '/api/activity/1/module_instances');
        $response->assertStatus(404);
    }

    /** @test */
    public function index_returns_module_instances_of_an_activity(){
        $activity = factory(Activity::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->create([
            'activity_id' => $activity->id
        ]);
        $response = $this->json('get', '/api/activity/' . $activity->id . '/module_instances');
        $response->assertOk();
        $response->assertJson($moduleInstances->toArray());
    }

}
