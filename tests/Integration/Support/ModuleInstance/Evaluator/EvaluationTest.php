<?php


namespace Tests\Integration\Support\ModuleInstance\Evaluator;


use App\Support\ModuleInstance\Evaluator\Evaluation;
use Tests\TestCase;

class EvaluationTest extends TestCase
{

    /** @test */
    public function the_active_status_can_be_set(){
        $evaluation = new Evaluation;
        $evaluation->setActive(true);
        $this->assertTrue($evaluation->active());

        $evaluation->setActive(false);
        $this->assertFalse($evaluation->active());
    }

    /** @test */
    public function the_visible_status_can_be_set(){
        $evaluation = new Evaluation;
        $evaluation->setVisible(true);
        $this->assertTrue($evaluation->visible());

        $evaluation->setVisible(false);
        $this->assertFalse($evaluation->visible());
    }

    /** @test */
    public function the_mandatory_status_can_be_set(){
        $evaluation = new Evaluation;
        $evaluation->setMandatory(true);
        $this->assertTrue($evaluation->mandatory());

        $evaluation->setMandatory(false);
        $this->assertFalse($evaluation->mandatory());
    }

    /** @test */
    public function all_properties_are_false_by_default(){
        $evaluation = new Evaluation;
        $this->assertFalse($evaluation->active());
        $this->assertFalse($evaluation->visible());
        $this->assertFalse($evaluation->mandatory());
    }


}
