<?php


namespace App\Support\Logic\Facade;


use App\Support\Logic\Contracts\LogicTester as LogicTesterContract;
use App\Support\Logic\Logic;
use Illuminate\Support\Facades\Facade;

/**
 * Class LogicTester
 * @package App\Support\Logic\Facade
 *
 * @method static LogicTesterContract evaluate(Logic $logic)
 *
 * @see LogicTesterContract
 */
class LogicTester extends Facade
{

    protected static function getFacadeAccessor()
    {
        return LogicTesterContract::class;
    }

}