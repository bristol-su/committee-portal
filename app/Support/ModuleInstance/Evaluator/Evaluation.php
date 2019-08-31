<?php


namespace App\Support\ModuleInstance\Evaluator;


use App\Support\ModuleInstance\Contracts\Evaluator\Evaluation as EvaluationContract;

class Evaluation implements EvaluationContract
{
    private $active = false;

    private $visible = false;

    private $mandatory = false;

    private $complete = false;

    public function active(): bool
    {
        return $this->active;
    }

    public function mandatory(): bool
    {
        return $this->mandatory;
    }

    public function complete(): bool
    {
        return $this->complete;
    }

    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    public function setMandatory(bool $mandatory)
    {
        $this->mandatory = $mandatory;
    }

    public function setVisible(bool $visible)
    {
        $this->visible = $visible;
    }

    public function setComplete(bool $complete)
    {
        $this->complete = $complete;
    }

    public function visible(): bool
    {
        return $this->visible;
    }

    public function toArray()
    {
        return [
            'active' => $this->active(),
            'visible' => $this->visible(),
            'mandatory' => $this->mandatory(),
            'complete' => $this->complete()
        ];
    }


}
