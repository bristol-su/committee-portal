<?php

namespace Tests;

use App\Authentication\ViewAsStudent;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInAsSuperAdminActingAsGroup()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('act-as-super-admin');
        $this->be($user);
        $viewAsStudent = new ViewAsStudent(1);
        $this->actingAs($viewAsStudent, 'view-as-student');
        return $this;
    }
}
