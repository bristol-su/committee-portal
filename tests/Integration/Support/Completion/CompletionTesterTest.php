<?php


namespace Tests\Integration\Support\Completion;


use App\Support\Activity\Activity;
use App\Support\Authentication\Contracts\Authentication;
use App\Support\Completion\CompletionTester;
use App\Support\Control\Models\Group;
use App\Support\EventStore\Contracts\EventStoreRepository;
use App\Support\ModuleInstance\ModuleInstance;
use App\User;
use Prophecy\Argument;
use Tests\TestCase;

class CompletionTesterTest extends TestCase
{

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    private $authentication;
    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    private $eventStoreRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->authentication = $this->prophesize(Authentication::class);
        $this->eventStoreRepository = $this->prophesize(EventStoreRepository::class);
    }

    /** @test */
    public function evaluate_passes_the_module_instance_id_to_the_event_repository()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->eventStoreRepository->has(Argument::that(function($arg) use ($moduleInstance) {
            return $arg['module_instance_id'] === $moduleInstance->id;
        }))->shouldBeCalled();
        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->evaluate($moduleInstance, 1);

    }

    /** @test */
    public function evaluate_passes_the_event_to_the_event_repository()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->eventStoreRepository->has(Argument::that(function($arg) use ($moduleInstance) {
            return $arg['event'] === $moduleInstance->complete;
        }))->shouldBeCalled();
        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->evaluate($moduleInstance, 1);
    }

    /** @test */
    public function evaluate_passes_the_user_id_to_the_event_repository_if_given()
    {
        $userId = 5;
        $activity = factory(Activity::class)->create(['activity_for' => 'user']);
        $moduleInstance = factory(ModuleInstance::class)->create(['activity_id' => $activity->id]);
        $this->eventStoreRepository->has(Argument::that(function($arg) use ($userId) {
            return isset($arg['user_id']) && !isset($arg['group_id']) && $userId === $arg['user_id'];
        }))->shouldBeCalled();
        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->evaluate($moduleInstance, $userId);
    }

    /** @test */
    public function evaluate_passes_the_group_id_to_the_event_repository_if_given()
    {
        $groupId = 4;
        $activity = factory(Activity::class)->create(['activity_for' => 'group']);
        $moduleInstance = factory(ModuleInstance::class)->create(['activity_id' => $activity->id]);
        $this->eventStoreRepository->has(Argument::that(function($arg) use ($groupId) {
            return isset($arg['group_id']) && !isset($arg['user_id']) && $groupId === $arg['group_id'];
        }))->shouldBeCalled();
        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->evaluate($moduleInstance, $groupId);
    }

    /** @test */
    public function evaluate_returns_true_if_the_event_repository_returns_true()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->eventStoreRepository->has(Argument::any())->willReturn(true);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $this->assertTrue(
            $completionTester->evaluate($moduleInstance, 1)
        );
    }

    /** @test */
    public function evaluate_returns_false_if_the_event_repository_returns_false()
    {
        $moduleInstance = factory(ModuleInstance::class)->create();
        $this->eventStoreRepository->has(Argument::any())->willReturn(false);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $this->assertFalse(
            $completionTester->evaluate($moduleInstance, 2)
        );
    }

    /** @test */
    public function getModelId_returns_authentication_getUser_if_for_is_user()
    {
        $user = factory(User::class)->create();
        $this->authentication->getUser()->shouldBeCalled()->willReturn($user);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $this->assertEquals($user->id, $completionTester->getModelId('user'));
    }

    /** @test */
    public function getModelId_returns_authentication_getGroup_if_for_is_group()
    {
        $group = new Group(['id' => 1]);
        $this->authentication->getGroup()->shouldBeCalled()->willReturn($group);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $this->assertEquals($group->id, $completionTester->getModelId('group'));
    }

    /** @test */
    public function getModelId_throws_an_exception_if_for_is_not_group_or_user()
    {
        $this->expectException(\Exception::class);
        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->getModelId('notgrouporuser');
    }

    /** @test */
    public function getModelId_throws_an_exception_if_for_user_and_user_not_logged_in(){
        $this->expectException(\Exception::class);
        $this->authentication->getUser()->shouldBeCalled()->willReturn(null);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->getModelId('user');
    }

    /** @test */
    public function getModelId_throws_an_exception_if_for_group_and_group_not_logged_in(){
        $this->expectException(\Exception::class);
        $this->authentication->getGroup()->shouldBeCalled()->willReturn(null);

        $completionTester = new CompletionTester($this->authentication->reveal(), $this->eventStoreRepository->reveal());
        $completionTester->getModelId('group');
    }



}
