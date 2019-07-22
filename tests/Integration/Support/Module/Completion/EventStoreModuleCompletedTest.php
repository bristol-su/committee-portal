<?php


namespace Tests\Integration\Support\Module\Completion;


use App\Support\EventStore\EventStore;
use App\Support\Module\Completion\EventStoreModuleCompleted;
use App\Support\Module\ModuleInstance\ModuleInstance;

class EventStoreModuleCompletedTest
{


    /** @test */
    public function it_returns_false_if_the_module_instance_does_not_exist_in_the_database(){
        $moduleInstance = factory(ModuleInstance::class)->make();
        $moduleCompleted = new EventStoreModuleCompleted;
        $this->assertFalse(
            $moduleCompleted->complete($moduleInstance)
        );
    }

    /** @test */
    public function it_returns_false_if_there_are_no_events_from_the_module_instance_in_storage(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $moduleCompleted = new EventStoreModuleCompleted;
        $this->assertFalse(
            $moduleCompleted->complete($moduleInstance)
        );
    }

    /** @test */
    public function it_searches_for_a_role_id_if_the_event_is_for_students(){

    }

    /** @test */
    public function it_searches_for_a_group_if_if_event_for_groups(){

    }

    /** @test */
    public function it_returns_false_if_student_event_found_but_not_matching_role_id(){

    }

    /** @test */
    public function it_returns_false_if_group_event_found_but_not_matching_group_id(){

    }

    /** @test */
    public function it_returns_false_if_student_event_not_found_but_matching_role_id_is(){

    }

    /** @test */
    public function it_returns_false_if_group_event_not_found_but_matching_group_id_is(){

    }

    /** @test */
    public function it_returns_true_if_correct_role_found_for_correct_student_event(){

    }

    /** @test */
    public function it_returns_true_if_correct_group_id_found_for_correct_group_event(){

    }

}