<?php

namespace App\Support\ModuleInstance\Contracts\Evaluator;

use Illuminate\Contracts\Support\Arrayable;

interface Evaluation extends Arrayable
{

    public function setVisible(bool $visible);

    public function setMandatory(bool $mandatory);

    public function setActive(bool $active);

    public function setComplete(bool $complete);

    public function visible(): bool;

    public function mandatory(): bool;

    public function active(): bool;

    public function complete(): bool;

}
