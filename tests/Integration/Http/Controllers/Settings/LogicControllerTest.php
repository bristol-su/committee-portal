<?php


namespace Tests\Integration\Http\Controllers\Settings;


use BristolSU\Support\Logic\Contracts\LogicRepository;
use BristolSU\Support\Logic\Logic;
use Tests\TestCase;

class LogicControllerTest extends TestCase
{

    /** @test */
    public function index_loads_the_correct_view(){
        $response = $this->get('/settings/logic');
        $response->assertViewIs('settings.logic.index');
    }

    /** @test */
    public function index_passes_all_logic_from_the_repository_into_the_view(){
        $logics = factory(Logic::class, 10)->create();
        $logicRepository = $this->prophesize(LogicRepository::class);
        $logicRepository->all()->shouldBeCalled()->willReturn($logics);
        $this->instance(LogicRepository::class, $logicRepository->reveal());
        $response = $this->get('/settings/logic');

        $response->assertViewHas('logics');
        $responseLogic = $response->original->gatherData()['logics'];

        foreach($logics as $logic) {
            $this->assertModelEquals($logic, $responseLogic->shift());
        }
    }

    /** @test */
    public function show_loads_the_correct_view(){
        $logic = factory(Logic::class)->create();
        $response = $this->get('/settings/logic/' . $logic->id);
        $response->assertViewIs('settings.logic.show');
    }

    /** @test */
    public function show_passes_the_correct_logic_to_the_view(){
        $logic = factory(Logic::class)->create();
        $response = $this->get('/settings/logic/' . $logic->id);
        $response->assertViewHas('logic');
        $this->assertModelEquals($logic, $response->original->gatherData()['logic']);
    }

    /** @test */
    public function create_returns_the_correct_view(){
        $response = $this->get('/settings/logic/create');
        $response->assertViewIs('settings.logic.create');
;    }
}
