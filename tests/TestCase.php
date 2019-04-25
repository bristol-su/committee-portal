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
use Tests\Traits\PosesAsAuthenticated;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, PosesAsAuthenticated;

    public function assertNotAuthenticated($guard = 'web')
    {
        $this->assertFalse($this->isAuthenticated($guard));

        return $this;
    }
}
