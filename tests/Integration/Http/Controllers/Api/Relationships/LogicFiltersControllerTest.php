<?php


namespace Tests\Integration\Http\Controllers\Api\Relationships;


use App\Support\Filters\FilterInstance;
use App\Support\Logic\Logic;
use App\Support\ModuleInstance\ModuleInstance;
use Tests\TestCase;

class LogicFiltersControllerTest extends TestCase
{

    /** @test */
    public function index_returns_404_if_logic_not_found(){
        $response = $this->json('get', '/api/logic/1/filters');
        $response->assertStatus(404);
    }

    /** @test */
    public function index_returns_filter_instances_of_logic(){
        $logic = factory(Logic::class)->create();
        $filters = factory(FilterInstance::class, 10)->create([
            'logic_id' => $logic->id
        ]);
        $response = $this->json('get', '/api/logic/' . $logic->id . '/filters');
        $response->assertOk();
        $response->assertJson($filters->toArray());
    }

}
