<?php


namespace Tests\Integration\Http\Controllers\Api;


use BristolSU\Support\Filters\FilterInstance;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\User\User;
use Tests\TestCase;

class LogicControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }
    /** @test */
    public function show_returns_the_logic()
    {
        $logic = factory(Logic::class)->create();
        $response = $this->json('get', '/api/logic/' . $logic->id);
        $response->assertExactJson($logic->toArray());
    }

    /** @test */
    public function show_returns_404_if_logic_not_found()
    {
        $response = $this->json('get', '/api/logic/1');
        $response->assertStatus(404);
    }

    /** @test */
    public function index_returns_all_logic()
    {
        $logics = factory(Logic::class, 10)->create();

        $response = $this->json('get', '/api/logic');
        $response->assertExactJson($logics->toArray());
    }

    /** @test */
    public function store_returns_the_logic()
    {
        $parameters = [
            'name' => 'Name',
            'description' => 'A Description',
            'for' => 'user'
        ];
        $response = $this->json('post', '/api/logic', $parameters);
        $response->assertJson($parameters);
    }

    /** @test */
    public function store_stores_logic_in_the_database()
    {
        $parameters = [
            'name' => 'Name',
            'description' => 'A Description',
            'for' => 'user'
        ];
        $response = $this->json('post', '/api/logic', $parameters);
        $this->assertDatabaseHas('logics', $parameters);
    }

    /** @test */
    public function store_stores_logic_type_and_logic_id_in_the_database()
    {
        $allTrueFilters = factory(FilterInstance::class, 5)->create();
        $allFalseFilters = factory(FilterInstance::class, 5)->create();
        $anyTrueFilters = factory(FilterInstance::class, 5)->create();
        $anyFalseFilters = factory(FilterInstance::class, 5)->create();

        $parameters = [
            'name' => 'Name',
            'description' => 'A Description',
            'for' => 'user',
            'all_true' => $allTrueFilters->pluck('id'),
            'all_false' => $allFalseFilters->pluck('id'),
            'any_true' => $anyTrueFilters->pluck('id'),
            'any_false' => $anyFalseFilters->pluck('id')
        ];

        $response = $this->json('post', '/api/logic', $parameters);
        $logicId = json_decode($response->getContent())->id;

        $allTrueFilters->each(function(FilterInstance $filter) use ($logicId) {
            $filter = FilterInstance::findOrFail($filter->id);
            $this->assertEquals($logicId, $filter->logic->id);
            $this->assertEquals('all_true', $filter->logic_type);
        });
        $allFalseFilters->each(function(FilterInstance $filter) use ($logicId) {
            $filter = FilterInstance::findOrFail($filter->id);
            $this->assertEquals($logicId, $filter->logic->id);
            $this->assertEquals('all_false', $filter->logic_type);
        });
        $anyTrueFilters->each(function(FilterInstance $filter) use ($logicId) {
            $filter = FilterInstance::findOrFail($filter->id);
            $this->assertEquals($logicId, $filter->logic->id);
            $this->assertEquals('any_true', $filter->logic_type);
        });
        $anyFalseFilters->each(function(FilterInstance $filter) use ($logicId) {
            $filter = FilterInstance::findOrFail($filter->id);
            $this->assertEquals($logicId, $filter->logic->id);
            $this->assertEquals('any_false', $filter->logic_type);
        });
    }

}
