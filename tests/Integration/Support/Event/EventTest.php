<?php


namespace Tests\Integration\Support\Event;


use App\Support\Event\Event;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EventTest extends TestCase
{

    /** @test */
    public function it_has_many_module_instances()
    {
        $event = factory(Event::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 10)->make();
        $event->moduleInstances()->saveMany($moduleInstances);

        for ($i = 0; $i < $moduleInstances->count(); $i++) {

            $this->assertTrue($moduleInstances[$i]->is(
                $event->moduleInstances[$i])
            );
        }
    }

    /** @test */
    public function it_retrieves_always_active_events(){
        $event = factory(Event::class)->create([
            'start_date' => null, 'end_date' => null
        ]);
        $retrieved = Event::active()->get();

        $this->assertModelEquals($event, $retrieved->first());
    }

    /** @test */
    public function it_retrieves_an_active_event_in_a_date_range(){
        $event = factory(Event::class)->create([
            'start_date' => Carbon::now()->subDays(5), 'end_date' => Carbon::now()->addDays(5)
        ]);

        $retrieved = Event::active()->get();

        $this->assertModelEquals($event, $retrieved->first());
    }

    /** @test */
    public function it_does_not_retrieve_an_event_if_the_event_is_not_in_the_date_range(){
        $event = factory(Event::class)->create([
            'start_date' => Carbon::now()->subDays(5), 'end_date' => Carbon::now()->subdays(1)
        ]);
        $retrieved = Event::active()->get();

        $this->assertCount(0, $retrieved);
    }

}