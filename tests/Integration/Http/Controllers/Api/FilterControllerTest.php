<?php


namespace Tests\Integration\Http\Controllers\Api;


use App\Support\Filters\Contracts\FilterRepository;
use App\Support\Filters\Contracts\Filters\Filter;
use Illuminate\Support\Collection;
use Tests\TestCase;

class FilterControllerTest extends TestCase
{

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
