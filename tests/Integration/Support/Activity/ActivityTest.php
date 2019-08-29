<?php


namespace Tests\Integration\Support\Activity;


use App\Support\Activity\Activity;
use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use Carbon\Carbon;
use Tests\TestCase;

class ActivityTest extends TestCase
{

    /**
     * @test
     */
    public function it_has_many_module_instances()
    {
        $activity = factory(Activity::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->make();
        $activity->moduleInstances()->saveMany($moduleInstances);

        for ($i = 0; $i < $moduleInstances->count(); $i++) {

            $this->assertTrue($moduleInstances[$i]->is(
                $activity->moduleInstances[$i])
            );
        }
    }

    /**
     * @test
     */
    public function active_retrieves_always_active_events()
    {
        $activity = factory(Activity::class)->create([
            'start_date' => null, 'end_date' => null
        ]);
        $retrieved = Activity::active()->get();

        $this->assertModelEquals($activity, $retrieved->first());
    }

    /**
     * @test
     */
    public function active_retrieves_an_active_activity_in_a_date_range()
    {
        $activity = factory(Activity::class)->create([
            'start_date' => Carbon::now()->subDays(5), 'end_date' => Carbon::now()->addDays(5)
        ]);

        $retrieved = Activity::active()->get();

        $this->assertModelEquals($activity, $retrieved->first());
    }

    /**
     * @test
     */
    public function active_does_not_retrieve_an_activity_if_the_activity_is_not_in_the_date_range()
    {
        $activity = factory(Activity::class)->create([
            'start_date' => Carbon::now()->subDays(5), 'end_date' => Carbon::now()->subdays(1)
        ]);
        $retrieved = Activity::active()->get();

        $this->assertCount(0, $retrieved);
    }


    /** @test */
    public function it_has_a_for_logic(){
        $activity = factory(Activity::class)->create();
        $this->assertInstanceOf(Logic::class, $activity->forLogic);
        $this->assertEquals($activity->for_logic, $activity->forLogic->id);
    }

    /** @test */
    public function it_has_an_admin_logic(){
        $activity = factory(Activity::class)->create();
        $this->assertInstanceOf(Logic::class, $activity->adminLogic);
        $this->assertEquals($activity->admin_logic, $activity->adminLogic->id);
    }

}
