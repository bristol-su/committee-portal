<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Filters\Contracts\FilterInstanceRepository;
use App\Support\Filters\FilterInstance;
use App\Support\Logic\Logic;
use Tests\TestCase;

class FilterInstanceControllerTest extends TestCase
{

    /** @test */
    public function store_calls_create_on_the_filter_repository(){
        $parameters = [
            'alias' => 'alias1',
            'name' => 'A Name',
            'settings' => ['some' => 'settings'],
        ];

        $filterInstanceRepo = $this->prophesize(FilterInstanceRepository::class);
        $filterInstanceRepo->create($parameters)->shouldBeCalled()->willReturn(FilterInstance::create($parameters));
        $this->instance(FilterInstanceRepository::class, $filterInstanceRepo->reveal());

        $response = $this->json('post', '/api/filter_instances', $parameters);
        $response->assertStatus(201);
    }

    /** @test */
    public function store_stores_an_filter_in_the_database(){
        $parameters = [
            'alias' => 'alias1',
            'name' => 'A Name',
            'settings' => ['some' => 'settings'],
        ];

        $response = $this->json('post', '/api/filter_instances', $parameters);
        $response->assertStatus(201);

        $this->assertDatabaseHas('filter_instances', [
            'alias' => 'alias1',
            'name' => 'A Name',
            'settings' => json_encode(['some' => 'settings']),
        ]);

    }
}
