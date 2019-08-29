<?php


namespace Tests\Integration\Support\Authentication\AuthenticationProvider;


use App\Support\Authentication\AuthenticationProvider\GroupProvider;
use App\Support\Control\Contracts\Repositories\Group as GroupRepositoryContract;
use App\Support\Control\Models\Group;
use App\User;
use Tests\TestCase;

class GroupProviderTest extends TestCase
{

    /** @test */
    public function retrieve_by_id_retrieves_a_group_by_id(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);
        $groupRepository->getById(1)->shouldBeCalled()->willReturn(new Group(['id' => 1]));

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertEquals(1, $groupProvider->retrieveById(1)->id);
    }

    /** @test */
    public function retrieve_by_credentials_retrieves_a_group_by_credentials(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);
        $groupRepository->getById(1)->shouldBeCalled()->willReturn(new Group(['id' => 1]));

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertEquals(1, $groupProvider->retrieveByCredentials(['group_id' => 1])->id);
    }

    /** @test */
    public function retrieve_by_credentials_returns_null_if_group_id_not_set(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertNull($groupProvider->retrieveByCredentials([]));
    }

    /** @test */
    public function validate_credentials_returns_true_if_group_id_valid(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);
        $groupRepository->getById(1)->shouldBeCalled()->willReturn(new Group(['id' => 1]));
        $user = factory(User::class)->create();

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertTrue($groupProvider->validateCredentials($user, ['group_id' => 1]));
    }

    /** @test */
    public function validate_credentials_returns_false_if_group_id_not_found(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);
        $groupRepository->getById(1)->shouldBeCalled()->willThrow(new \Exception);
        $user = factory(User::class)->create();

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertFalse($groupProvider->validateCredentials($user, ['group_id' => 1]));
    }

    /** @test */
    public function validate_credentials_returns_false_if_group_id_not_given(){
        $groupRepository = $this->prophesize(GroupRepositoryContract::class);
        $user = factory(User::class)->create();

        $groupProvider = new GroupProvider($groupRepository->reveal());
        $this->assertFalse($groupProvider->validateCredentials($user, []));
    }



}
