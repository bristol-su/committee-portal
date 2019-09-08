<?php


namespace App\Support\Permissions;


use App\Support\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use App\Support\Permissions\Contracts\PermissionTester as PermissionTesterContract;
use App\Support\Permissions\Contracts\Testers\Tester;

class PermissionTester implements PermissionTesterContract
{

    /**
     * @var Tester[]
     */
    private $testers = [];

    public function evaluate(string $ability): bool
    {
        $tester = $this->getChain();
        $result = $tester->can($ability);
        return ($result?:false);
    }

    public function getChain()
    {
        if(count($this->testers) === 0) {
            throw new \Exception('No testers registered');
        }
        $testers = $this->testers;
        for ($i = 0; $i < (count($testers) - 1); $i++) {
            $testers[$i]->setNext($testers[$i + 1]);
        }
        return $testers[0];
    }

    public function register(Tester $tester)
    {
        $this->testers[] = $tester;
    }
}
