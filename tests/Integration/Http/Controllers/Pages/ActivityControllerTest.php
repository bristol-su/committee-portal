<?php


namespace Tests\Integration\Http\Controllers\Pages;


use App\Http\Controllers\Pages\ActivityController;
use App\Http\Controllers\Pages\PortalController;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\ModuleInstance\Contracts\Evaluator\ActivityEvaluator as ActivityEvaluatorContract;
use BristolSU\Support\ModuleInstance\Contracts\Evaluator\ModuleInstanceEvaluator as ModuleInstanceEvaluatorContract;
use BristolSU\Support\ModuleInstance\Evaluator\ActivityEvaluator;
use BristolSU\Support\ModuleInstance\Evaluator\Evaluation;
use BristolSU\Support\ModuleInstance\ModuleInstance;
use BristolSU\Support\ModuleInstance\Evaluator\ModuleInstanceEvaluator;
use BristolSU\Support\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Prophecy\Argument;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user);
    }

    public function loadActivity($activity, $isAdmin=false)
    {
        if($isAdmin) {
            return $this->get('/admin/' . $activity->slug);
        }
        return $this->get('/' . $activity->slug);
    }

    /** @test */
    public function admin_returns_the_correct_view(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadActivity($activity, true);
        $response->assertViewIs('portal.portalcontent');
    }

    /** @test */
    public function participant_returns_the_correct_view(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadActivity($activity, false);
        $response->assertViewIs('portal.portalcontent');
    }

    /** @test */
    public function administrator_attaches_admin_true_to_the_view(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadActivity($activity, true);
        $response->assertViewHas('admin', true);
    }

    /** @test */
    public function participant_attaches_admin_false_to_the_view(){
        $activity = factory(Activity::class)->create();
        $response = $this->loadActivity($activity, false);
        $response->assertViewHas('admin', false);
    }

    /** @test */
    public function administrator_passes_the_evaluated_activity_into_the_view(){
        $activity = factory(Activity::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 2)->make();
        $activity->moduleInstances()->saveMany($moduleInstances);

        $evaluator = $this->prophesize(ActivityEvaluator::class);
        $collection = new Collection;
        $evaluator->evaluateAdministrator(Argument::that(function($givenActivity) use ($activity){
            return $givenActivity->id === $activity->id;
        }))->shouldBeCalled()->willReturn($collection);
        $this->instance(ActivityEvaluatorContract::class, $evaluator->reveal());

        $response = $this->loadActivity($activity, true);
        $response->assertViewHas('evaluation', $collection);
    }

    /** @test */
    public function participant_passes_the_evaluated_activity_into_the_view(){
        $activity = factory(Activity::class)->create();
        $moduleInstances = factory(ModuleInstance::class, 2)->make();
        $activity->moduleInstances()->saveMany($moduleInstances);

        $evaluator = $this->prophesize(ActivityEvaluator::class);
        $collection = new Collection;
        $evaluator->evaluateParticipant(Argument::that(function($givenActivity) use ($activity){
            return $givenActivity->id === $activity->id;
        }))->shouldBeCalled()->willReturn($collection);
        $this->instance(ActivityEvaluatorContract::class, $evaluator->reveal());

        $response = $this->loadActivity($activity, false);
        $response->assertViewHas('evaluation', $collection);
    }

    /** @test */
    public function participant_evaluates_activities_correctly(){
        $activity = factory(Activity::class)->create();
        $moduleInstance1 = factory(ModuleInstance::class)->make();
        $moduleInstance2 = factory(ModuleInstance::class)->make();
        $activity->moduleInstances()->saveMany([$moduleInstance1, $moduleInstance2]);
        $this->createLogicTester(
            [$activity->forLogic, $moduleInstance1->activeLogic, $moduleInstance1->visibleLogic, $moduleInstance2->activeLogic],
            [$activity->adminLogic, $moduleInstance1->mandatoryLogic, $moduleInstance2->visibleLogic, $moduleInstance2->mandatoryLogic]
        );

        $response = $this->loadActivity($activity, false);
        $response->assertViewHas('evaluation');
        $evaluationResult = $response->original->gatherData()['evaluation'];

        $this->assertTrue($evaluationResult[$moduleInstance1->id]->active());
        $this->assertTrue($evaluationResult[$moduleInstance1->id]->visible());
        $this->assertFalse($evaluationResult[$moduleInstance1->id]->mandatory());
        $this->assertTrue($evaluationResult[$moduleInstance2->id]->active());
        $this->assertFalse($evaluationResult[$moduleInstance2->id]->visible());
        $this->assertFalse($evaluationResult[$moduleInstance2->id]->mandatory());

    }

}
