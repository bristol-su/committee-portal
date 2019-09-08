<?php


namespace App\Support\Permissions\Facade;


use App\Support\Permissions\Contracts\PermissionTester as PermissionTesterContract;
use App\Support\Permissions\Contracts\Testers\Tester;
use Illuminate\Support\Facades\Facade;

/**
 * Class PermissionTester
 * @method static bool evaluate(string $ability) Test a Permission
 * @method static void register(Tester $tester) Register a permission tester

 * @package App\Support\Permissions\Facade
 */
class PermissionTester extends Facade
{

    protected static function getFacadeAccessor()
    {
        return PermissionTesterContract::class;
    }

}
