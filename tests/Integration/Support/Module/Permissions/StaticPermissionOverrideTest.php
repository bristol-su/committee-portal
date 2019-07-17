<?php


namespace Tests\Integration\Support\Module\Permissions;


use App\Support\Module\Permissions\StaticPermissionOverride;
use App\User;
use Tests\TestCase;

class StaticPermissionOverrideTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_the_user_has_a_true_permission_override(){
        $user = factory(User::class)->create();
        $permissionOverride = factory(StaticPermissionOverride::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
            'result' => true
        ]);

        $this->assertTrue(StaticPermissionOverride::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_false_if_the_user_has_a_false_permission_override(){
        $user = factory(User::class)->create();
        $permissionOverride = factory(StaticPermissionOverride::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
            'result' => false
        ]);

        $this->assertFalse(StaticPermissionOverride::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_null_if_the_user_has_no_matching_permission_override(){
        $user = factory(User::class)->create();
        $this->assertNull(StaticPermissionOverride::passes($user, 'some-permission'));
    }

    /** @test */
    public function it_returns_null_if_the_user_has_permission_override_for_a_different_permission(){
        $user = factory(User::class)->create();
        $permissionOverride = factory(StaticPermissionOverride::class)->create([
            'user_id' => $user->id,
            'permission' => 'some-permission',
            'result' => false
        ]);

        $this->assertNull(StaticPermissionOverride::passes($user, 'some-other-permission'));
    }

}