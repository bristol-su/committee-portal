<?php


namespace Tests\Integration\Support\Authentication\AuthenticationProvider;


use App\Support\Authentication\AuthenticationProvider\RoleProvider;
use App\Support\Control\Contracts\Repositories\Role as RoleRepositoryContract;
use App\Support\Control\Models\Role;
use App\User;
use Tests\TestCase;

class RoleProviderTest extends TestCase
{

    /** @test */
    public function retrieve_by_id_retrieves_a_role_by_id(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $roleRepository->getById(1)->shouldBeCalled()->willReturn(new Role(['id' => 1]));

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertEquals(1, $roleProvider->retrieveById(1)->id);
    }

    /** @test */
    public function retrieve_by_credentials_retrieves_a_role_by_credentials(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $roleRepository->getById(1)->shouldBeCalled()->willReturn(new Role(['id' => 1]));

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertEquals(1, $roleProvider->retrieveByCredentials(['committee_role_id' => 1])->id);
    }

    /** @test */
    public function retrieve_by_credentials_returns_null_if_committee_role_id_not_set(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertNull($roleProvider->retrieveByCredentials([]));
    }

    /** @test */
    public function validate_credentials_returns_false_if_role_id_not_found(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $roleRepository->getById(1)->shouldBeCalled()->willThrow(new \Exception);
        $user = factory(User::class)->create();

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertFalse($roleProvider->validateCredentials($user, ['student_control_id' => 2, 'committee_role_id' => 1]));
    }

    /** @test */
    public function validate_credentials_returns_true_if_control_id_owns_role_id(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $roleRepository->getById(1)->shouldBeCalled()->willReturn(new Role(['id' => 1, 'student_id' => 2]));
        $user = factory(User::class)->create();

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertTrue($roleProvider->validateCredentials($user, ['student_control_id' => 2, 'committee_role_id' => 1]));
    }

    /** @test */
    public function validate_credentials_returns_false_if_control_id_does_not_own_role(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $roleRepository->getById(1)->shouldBeCalled()->willReturn(new Role(['id' => 1, 'student_id' => 3]));
        $user = factory(User::class)->create();

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertFalse($roleProvider->validateCredentials($user, ['student_control_id' => 2, 'committee_role_id' => 1]));
    }

    /** @test */
    public function validate_credentials_returns_false_if_control_id_or_role_id_are_not_given(){
        $roleRepository = $this->prophesize(RoleRepositoryContract::class);
        $user = factory(User::class)->create();

        $roleProvider = new RoleProvider($roleRepository->reveal());
        $this->assertFalse($roleProvider->validateCredentials($user, ['student_control_id' => 1]));
        $this->assertFalse($roleProvider->validateCredentials($user, ['committee_role_id' => 2]));
    }

}
