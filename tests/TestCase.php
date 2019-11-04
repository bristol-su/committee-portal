<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use BristolSU\Support\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function alias(): string
    {
        return 'support';
    }
}
