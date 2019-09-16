<?php


namespace Tests\Integration\Http\Controllers\Api;


use BristolSU\Support\Filters\Contracts\FilterRepository;
use BristolSU\Support\Filters\Contracts\Filters\Filter;
use BristolSU\Support\User\User;
use Illuminate\Support\Collection;
use Tests\TestCase;

class FilterControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }
    /** @test */
    public function index_calls_get_all_from_the_filter_repository(){
        $filters = [];
        for ($i=0; $i < 5;$i++) {
            $filter = $this->prophesize(Filter::class);
            $filter->toArray()->shouldBeCalled()->willReturn([
                'alias' => 'alias1',
                'name' => 'name1',
                'description' => 'description1',
                'for' => 'user',
                'options' => ['email' => '']
            ]);
            $filters[] = $filter;
        }

        $filterRepository = $this->prophesize(FilterRepository::class);
        $filterRepository->getAll()->shouldBeCalled()->willReturn($filters);
        $this->instance(FilterRepository::class, $filterRepository->reveal());

        $response = $this->json('get', '/api/filter');
    }

    /** @test */
    public function index_returns_all_filters_as_arrays(){
        $filters = new Collection;
        $responseValue = [];
        for ($i=0; $i < 5;$i++) {
            $filter = $this->prophesize(Filter::class);
            $filter->toArray()->shouldBeCalled()->willReturn([
                'alias' => 'alias1',
                'name' => 'name1',
                'description' => 'description1',
                'for' => 'user',
                'options' => ['email' => '']
            ]);
            $filters->push($filter->reveal());
            $responseValue[] = [
                'alias' => 'alias1',
                'name' => 'name1',
                'description' => 'description1',
                'for' => 'user',
                'options' => ['email' => '']
            ];
        }

        $filterRepository = $this->prophesize(FilterRepository::class);
        $filterRepository->getAll()->shouldBeCalled()->willReturn($filters);
        $this->instance(FilterRepository::class, $filterRepository->reveal());

        $response = $this->json('get', '/api/filter');
        $response->assertExactJson($responseValue);
    }



}
