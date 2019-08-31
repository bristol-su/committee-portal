<?php


namespace Tests\Integration\Support\EventStore;


use App\Support\EventStore\EventStore;
use App\Support\EventStore\EventStoreRepository;
use App\Support\ModuleInstance\ModuleInstance;
use App\User;
use Tests\TestCase;

class EventStoreRepositoryTest extends TestCase
{

    // TODO
    /** @test */
    public function create_creates_a_completion_event_in_the_database(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $user = factory(User::class)->create();
        $attributes = [
            'module_instance_id' => $moduleInstance->id,
            'user_id' => $user->id,
            'event' => 'SomeEvent',
            'keywords' => []
        ];

        $repository = new EventStoreRepository();
        $repository->create($attributes);
        $this->assertDatabaseHas('event_stores', [
            'module_instance_id' => $moduleInstance->id,
            'user_id' => $user->id,
            'event' => 'SomeEvent',
            'keywords' => json_encode([])
        ]);
    }

    /** @test */
    public function has_returns_true_if_the_given_data_exists_in_the_database(){
        $eventStore = factory(EventStore::class)->create();
        $repository = new EventStoreRepository();

        $this->assertTrue($repository->has([
            'module_instance_id' => $eventStore->module_instance_id,
            'event' => $eventStore->event,
            'user_id' => $eventStore->user_id
        ]));

    }

    /** @test */
    public function has_returns_false_if_the_given_data_exists_in_the_database(){
        $repository = new EventStoreRepository();

        $this->assertFalse($repository->has([
            'module_instance_id' => 11,
            'event' => 'Not a real event store',
            'user_id' => 12
        ]));

    }



}
