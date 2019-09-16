<?php

namespace Tests\Integration\Http\Controllers\Settings;

use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\ModuleInstance\ModuleInstance;
use BristolSU\Support\User\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ModuleInstanceControllerTest extends TestCase
{

    /** @test */
    public function show_returns_the_correct_view()
    {
        $activity = factory(Activity::class)->create();
        $moduleInstance = factory(ModuleInstance::class)->create([
            'activity_id' => $activity
        ]);
        $response = $this->get('/settings/activity/'.$activity->id.'/module_instance/' . $moduleInstance->id);

        $response->assertOk();
        $response->assertViewIs('settings.module_instances.show');
    }

    /** @test */
    public function show_returns_a_404_if_the_activity_is_not_found()
    {
        $response = $this->get('/settings/activity/1/module_instance/1');
        $response->assertStatus(404);
    }

    /** @test */
    public function show_returns_a_404_if_the_module_instance_does_not_belong_to_activity()
    {
        $activity = factory(Activity::class)->create();
        $otherActivity = factory(Activity::class)->create();
        $moduleInstance = factory(ModuleInstance::class)->create([
            'activity_id' => $activity
        ]);
        $response = $this->get('/settings/activity/'.$otherActivity->id.'/module_instance/' . $moduleInstance->id);
        $response->assertStatus(404);
    }


    /** @test */
    public function show_passes_the_module_instance_to_the_view()
    {
        $activity = factory(Activity::class)->create();
        $moduleInstance = factory(ModuleInstance::class)->create([
            'activity_id' => $activity
        ]);
        $response = $this->get('/settings/activity/'.$activity->id.'/module_instance/' . $moduleInstance->id);

        $response->assertViewHas('moduleInstance');
        $this->assertModelEquals($moduleInstance, $response->original->gatherData()['moduleInstance']);
    }

    /** @test */
    public function create_returns_the_correct_view()
    {
        $activity = factory(Activity::class)->create();
        $response = $this->get('/settings/activity/' . $activity->id . '/module_instance/create');
        $response->assertViewIs('settings.module_instances.create');
    }

    /** @test */
    public function create_passes_activity_to_view()
    {
        $activity = factory(Activity::class)->create();
        $response = $this->get('/settings/activity/' . $activity->id . '/module_instance/create');

        $response->assertViewHas('activity');
        $this->assertModelEquals($activity, $response->original->gatherData()['activity']);
    }

}
