<?php

namespace App\Support\Logic\Contracts;

use App\Support\Logic\Logic;

interface LogicTester
{

    public function evaluate(Logic $logic);

}