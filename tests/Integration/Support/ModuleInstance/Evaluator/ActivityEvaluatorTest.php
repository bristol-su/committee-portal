<?php


namespace Tests\Integration\Support\ModuleInstance\Evaluator;


use App\Support\Activity\Activity;
use App\Support\ModuleInstance\Contracts\Evaluator\Evaluation;
use App\Support\ModuleInstance\Contracts\Evaluator\ModuleInstanceEvaluator;
use App\Support\ModuleInstance\Evaluator\ActivityEvaluator;
use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Support\Collection;
use Prophecy\Argument;
use Tests\TestCase;

class ActivityEvaluatorTest extends TestCase
{

    /** @test */
    public function participant_evaluates_each_module_instance(){
        $moduleInstances = factory(ModuleInstance::class, 3)->make();
        $activity = factory(Activity::class)->create();
        $activity->moduleInstances()->saveMany($moduleInstances);

        $moduleInstanceEvaluator = $this->prophesize(ModuleInstanceEvaluator::class);
        $evaluation = $this->prophesize(Evaluation::class);
        foreach($moduleInstances as $moduleInstance) {
            $moduleInstanceEvaluator->evaluateParticipant(Argument::that(function($givenModuleInstance) use ($moduleInstance) {
                return $givenModuleInstance->id == $moduleInstance->id;
            }))->shouldBeCalled()->willReturn($evaluation);
        }

        $activityEvaluator = new ActivityEvaluator($moduleInstanceEvaluator->reveal());
        $evaluations = $activityEvaluator->evaluateParticipant($activity);

        $this->assertCount($moduleInstances->count(), $evaluations);
        foreach($evaluations as $id => $evaluation) {
            $this->assertInstanceOf(Evaluation::class, $evaluation);
            $this->assertEquals($id, $moduleInstances->shift()->id);
        }
    }

    /** @test */
    public function administrator_evaluates_each_module_instance(){
        $moduleInstances = factory(ModuleInstance::class, 3)->make();
        $activity = factory(Activity::class)->create();
        $activity->moduleInstances()->saveMany($moduleInstances);

        $moduleInstanceEvaluator = $this->prophesize(ModuleInstanceEvaluator::class);
        $evaluation = $this->prophesize(Evaluation::class);
        foreach($moduleInstances as $moduleInstance) {
            $moduleInstanceEvaluator->evaluateAdministrator(Argument::that(function($givenModuleInstance) use ($moduleInstance) {
                return $givenModuleInstance->id == $moduleInstance->id;
            }))->shouldBeCalled()->willReturn($evaluation);
        }

        $activityEvaluator = new ActivityEvaluator($moduleInstanceEvaluator->reveal());
        $evaluations = $activityEvaluator->evaluateAdministrator($activity);

        $this->assertCount($moduleInstances->count(), $evaluations);
        foreach($evaluations as $id => $evaluation) {
            $this->assertInstanceOf(Evaluation::class, $evaluation);
            $this->assertEquals($id, $moduleInstances->shift()->id);
        }
    }


}
