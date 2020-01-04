<?php

namespace Tests\Integration\Http\Controllers\Auth;

use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\ControlDB\Contracts\Repositories\Role as RoleRepository;
use BristolSU\ControlDB\Models\Role;
use BristolSU\Support\User\User;
use Tests\TestCase;

class LogIntoRoleControllerTest extends TestCase
{

    /** @test */
    public function login_finds_the_role_by_id(){
        $role = new Role(['id' => 5]);
        $user = factory(User::class)->create();
        $this->be($user);
        $roleRepository = $this->prophesize(RoleRepository::class);
        $roleRepository->getById(5)->shouldBeCalled()->willReturn($role);

        $this->instance(RoleRepository::class, $roleRepository->reveal());

        $response = $this->post('/login/role', ['role_id' => 5]);
    }

    /** @test */
    public function login_sets_the_role(){
        $role = new Role(['id' => 5]);
        $user = factory(User::class)->create();
        $this->be($user);

        $roleRepository = $this->prophesize(RoleRepository::class);
        $roleRepository->getById(5)->willReturn($role);
        $authentication = $this->prophesize(Authentication::class);
        $authentication->setRole($role)->shouldBeCalled();
        $this->instance(RoleRepository::class, $roleRepository->reveal());
        $this->instance(Authentication::class, $authentication->reveal());
        $response = $this->post('/login/role', ['role_id' => 5]);
    }

    /** @test */
    public function login_returns_a_redirect_response(){
        $role = new Role(['id' => 5]);
        $user = factory(User::class)->create();
        $this->be($user);

        $roleRepository = $this->prophesize(RoleRepository::class);
        $roleRepository->getById(5)->willReturn($role);
        $authentication = $this->prophesize(Authentication::class);
        $this->instance(RoleRepository::class, $roleRepository->reveal());
        $this->instance(Authentication::class, $authentication->reveal());

        $response = $this->post('/login/role', ['role_id' => 5]);
        $response->assertRedirect();
    }

}
