<?php


namespace App\Support\Permissions\Contracts;


use App\Support\Permissions\Contracts\Testers\Tester;

interface PermissionTester
{

    public function evaluate(string $ability): bool;

    public function register(Tester $tester);

}
