<?php

namespace Tests\Integration\Support\EventStore;

use App\Support\EventStore\Contracts\EventStoreRepository;
use App\Support\EventStore\Contracts\StorableEvent;
use App\Support\EventStore\EventStore;
use App\Support\EventStore\EventStoreListener;
use App\Support\ModuleInstance\Contracts\ModuleInstanceRepository;
use App\Support\ModuleInstance\ModuleInstance;
use App\User;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Prophecy\Argument;
use Tests\TestCase;

class EventStoreListenerTest extends TestCase
{


    /** @test */
    public function it_dispatches_for_any_event_implementing_store_event()
    {
        Queue::fake();
        $event = $this->prophesize(StorableEvent::class);
        Event::dispatch($event->reveal());

        Queue::assertPushed(CallQueuedListener::class, function ($job) {
            return $job->class == EventStoreListener::class;
        });
    }

    /** @test */
    public function handle_retrieves_a_module_instance_from_the_repository()
    {

        $moduleInstance = factory(ModuleInstance::class)->create();
        $event = new DummyEvent($moduleInstance, ['foo', 'bar'], factory(User::class)->create()->id);
        $repository = $this->prophesize(ModuleInstanceRepository::class);
        $repository->getById(1)->shouldBeCalled()->willReturn($moduleInstance);

        $listener = new EventStoreListener($repository->reveal(), $this->prophesize(EventStoreRepository::class)->reveal());
        $listener->handle($event);
    }


    /** @test */
    public function handle_passes_attributes_to_be_created_to_the_repository()
    {
        $moduleInstance = factory(ModuleInstance::class)->create([
            'complete' => DummyEvent::class
        ]);
        $user = factory(User::class)->create();
        $event = new DummyEvent($moduleInstance, ['foo', 'bar'], $user->id, 6, 7);

        $eventStoreRepository = $this->prophesize(EventStoreRepository::class);
        $eventStoreRepository->create([
            'module_instance_id' => $moduleInstance->id,
            'keywords' => ['foo', 'bar'],
            'user_id' => $user->id,
            'group_id' => 6,
            'role_id' => 7,
            'event' => DummyEvent::class
        ])->shouldBeCalled();

        $listener = new EventStoreListener(new \App\Support\ModuleInstance\ModuleInstanceRepository, $eventStoreRepository->reveal());
        $listener->handle($event);
    }

    /** @test */
    public function handle_creates_a_row_in_the_database(){
        $moduleInstance = factory(ModuleInstance::class)->create([
            'complete' => DummyEvent::class
        ]);
        $user = factory(User::class)->create();
        $event = new DummyEvent($moduleInstance, ['foo', 'bar'], $user->id, 6, 7);

        $listener = new EventStoreListener(
            new \App\Support\ModuleInstance\ModuleInstanceRepository,
            new \App\Support\EventStore\EventStoreRepository
        );
        $listener->handle($event);

        $this->assertDatabaseHas('event_stores', [
            'module_instance_id' => $moduleInstance->id,
            'keywords' => json_encode(['foo', 'bar']),
            'user_id' => $user->id,
            'group_id' => 6,
            'role_id' => 7,
            'event' => DummyEvent::class
        ]);
    }


    /** @test */
    public function group_id_and_role_id_may_be_null(){
        $listener = new EventStoreListener(
            new \App\Support\ModuleInstance\ModuleInstanceRepository,
            new \App\Support\EventStore\EventStoreRepository
        );
        $moduleInstance = factory(ModuleInstance::class)->create([
            'complete' => DummyEvent::class
        ]);

        $event = new DummyEvent($moduleInstance, ['foo' => 'bar'], 1);
        $listener->handle($event);

        $this->assertDatabaseHas('event_stores', [
            'module_instance_id' => $moduleInstance->id,
            'event' => DummyEvent::class,
            'keywords' => json_encode(['foo' => 'bar']),
            'user_id' => 1,
            'group_id' => null,
            'role_id' => null
        ]);
    }

}


class DummyEvent implements StorableEvent {

    private $moduleInstance;
    private $keywords;
    private $userId;
    /**
     * @var null
     */
    private $groupId;
    /**
     * @var null
     */
    private $roleId;

    public function __construct($moduleInstance, $keywords, $userId, $groupId=null, $roleId=null)
    {
        $this->moduleInstance = $moduleInstance;
        $this->keywords = $keywords;
        $this->userId = $userId;
        $this->groupId = $groupId;
        $this->roleId = $roleId;
    }

    public function moduleInstanceId(): int
    {
        return $this->moduleInstance->id;
    }

    public function keywords(): array
    {
        return $this->keywords;
    }

    public function userId(): int {
        return $this->userId;
    }

    public function groupId(): ?int {
        return $this->groupId;
    }

    public function roleId(): ?int {
        return $this->roleId;
    }
}
