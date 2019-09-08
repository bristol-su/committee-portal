<?php


namespace App\Support\Permissions\Testers;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Logic\Contracts\LogicTester;
use App\Support\Logic\Logic;
use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\Models\ModelPermission;

class SystemLogicPermission extends Tester
{

    /**
     * @var Authentication
     */
    private $logicTester;

    public function __construct(LogicTester $logicTester)
    {
        $this->logicTester = $logicTester;
    }

    public function can(string $ability): ?bool
    {
        $permissions = ModelPermission::logic()->orderBy('created_at', 'ASC')->get();
        foreach($permissions as $permission) {
            if($this->logicTester->evaluate(Logic::findOrFail($permission->model_id))) {
                return $permission->result;
            }
        }
        return parent::next($ability);
    }
}
