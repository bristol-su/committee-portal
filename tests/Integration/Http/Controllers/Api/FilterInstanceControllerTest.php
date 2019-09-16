<?php


namespace Tests\Integration\Http\Controllers\Api;


use BristolSU\Support\Filters\Contracts\FilterInstanceRepository;
use BristolSU\Support\Filters\FilterInstance;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\User\User;
use Tests\TestCase;

class FilterInstanceControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }
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
