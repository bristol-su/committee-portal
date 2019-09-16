<?php

namespace Tests\Integration\Http\Controllers\Api\Relationships;

use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Repositories\Role as RoleRepository;
use BristolSU\Support\Control\Models\Role;
use BristolSU\Support\User\User;
use Illuminate\Support\Collection;
use Tests\TestCase;

class MeRolesControllerTest extends TestCase
{

    /** @test */
    public function index_passes_the_student_control_id_to_the_role_repository(){
        $user = factory(User::class)->create(['control_id' => 555]);
        $this->be($user, 'api');

        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn($user);
        $roleRepository = $this->prophesize(RoleRepository::class);

        $roleRepository->allFromStudentControlID(555)->shouldBeCalled()->willReturn(new Collection);

        $this->instance(Authentication::class, $authentication->reveal());
        $this->instance(RoleRepository::class, $roleRepository->reveal());
        $response = $this->json('get', '/api/me/roles');
    }

    /** @test */
    public function index_returns_the_role_repository_roles(){
        $user = factory(User::class)->create(['control_id' => 555]);
        $roles = new Collection([
            new Role(['id' => 1]),
            new Role(['id' => 2])
        ]);
        $this->be($user, 'api');
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->willReturn($user);
        $roleRepository = $this->prophesize(RoleRepository::class);

        $roleRepository->allFromStudentControlID(555)->shouldBeCalled()->willReturn($roles);
        $this->instance(Authentication::class, $authentication->reveal());
        $this->instance(RoleRepository::class, $roleRepository->reveal());
        $response = $this->json('get', '/api/me/roles');
        $response->assertJson($roles->toArray());
    }

}
