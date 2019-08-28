<?php

namespace Tests\Integration\Support\Completion;

use App\Support\Completion\EventStoreListener;
use App\Support\Completion\Contracts\StoreEvent;
use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EventStoreListenerTest extends TestCase
{

    /** @test */
    public function it_dispatches_for_any_event_implementing_store_event(){
        Queue::fake();
        $event = $this->prophesize(StoreEvent::class);
        Event::dispatch($event->reveal());

        Queue::assertPushed(CallQueuedListener::class, function ($job) {
            return $job->class == EventStoreListener::class;
        });
    }

    /** @test */
    public function it_saves_an_event_store_model_with_relevant_parameters(){
        $listener = new EventStoreListener;
        $moduleInstance = factory(ModuleInstance::class)->create();

        $event = new DummyEvent($moduleInstance, ['foo' => 'bar'], 1, 2, 3);
        $listener->handle($event);

        $this->assertDatabaseHas('event_stores', [
            'module_instance_id' => $moduleInstance->id,
            'activity_id' => $moduleInstance->activity->id,
            'event' => DummyEvent::class,
            'keywords' => json_encode(['foo' => 'bar']),
            'user_id' => 1,
            'group_id' => 2,
            'role_id' => 3
        ]);
    }

    /** @test */
    public function group_id_and_role_id_may_be_null(){
        $listener = new EventStoreListener;
        $moduleInstance = factory(ModuleInstance::class)->create();

        $event = new DummyEvent($moduleInstance, ['foo' => 'bar'], 1);
        $listener->handle($event);

        $this->assertDatabaseHas('event_stores', [
            'module_instance_id' => $moduleInstance->id,
            'activity_id' => $moduleInstance->activity->id,
            'event' => DummyEvent::class,
            'keywords' => json_encode(['foo' => 'bar']),
            'user_id' => 1,
            'group_id' => null,
            'role_id' => null
        ]);
    }

}


class DummyEvent implements StoreEvent {

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

    public function moduleInstance(): \App\Support\ModuleInstance\Contracts\ModuleInstance
    {
        return $this->moduleInstance;
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
