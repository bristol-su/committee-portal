<?php


namespace App\Support\ModuleInstance\Contracts\Evaluator;


interface Evaluation
{

    public function setVisible(bool $visible);

    public function setMandatory(bool $mandatory);

    public function setActive(bool $active);

    public function visible(): bool;

    public function mandatory(): bool;

    public function active(): bool;

}
