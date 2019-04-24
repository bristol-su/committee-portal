<?php

namespace Tests;

use App\Authentication\ViewAsStudent;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function signInAsSuperAdminActingAsStudent()
    {
        $this->beSuperAdmin();
        $this->haveViewAsStudent();
        return $this;
    }

    public function beStudent()
    {
        $user = $this->beUser();
        $this->haveCommitteeRole();
        return $user;
    }

    /**
     * @return User
     */
    public function beUser()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        return $user;
    }

    public function haveCommitteeRole()
    {
        $role = CommitteeRole::find(558);
        $this->be($role, 'committee-role');
        return $role;
    }

    public function beSuperAdmin()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('act-as-super-admin');
        $this->be($user);
        return $user;
    }

    public function haveViewAsStudent()
    {
        $viewAsStudent = new ViewAsStudent(1);
        $this->be($viewAsStudent, 'view-as-student');
        return $viewAsStudent;
    }

    /**
     * @return User
     */
    public function beAdmin()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('act-as-admin');
        $this->be($user);
        return $user;
    }
}
