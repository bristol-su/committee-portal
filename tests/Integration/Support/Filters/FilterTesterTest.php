<?php


namespace Tests\Integration\Support\Filters;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Control\Contracts\Models\Group;
use App\Support\Control\Contracts\Models\GroupTag as GroupTagModelContract;
use App\Support\Control\Contracts\Repositories\GroupTag as GroupTagRepositoryContract;
use App\Support\Filters\Contracts\FilterTester as FilterTesterContract;
use App\Support\Filters\FilterInstance;
use App\Support\Filters\FilterTester;
use Tests\TestCase;

class FilterTesterTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_the_filter_is_true(){

        $filterInstance = factory(FilterInstance::class)->create([
            'alias' => 'group_tagged',
            'settings' => ['tag' => 'reference']
        ]);

        $group = $this->prophesize(Group::class);

        // To make this filter true, the group must be tagged!
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getGroup()->willReturn($group->reveal());
        $this->instance(Authentication::class, $authentication->reveal());

        $groupTag = $this->prophesize(GroupTagModelContract::class);
        $groupTag->fullReference()->willReturn('reference');

        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $groupTagRepository->allThroughGroup($group->reveal())->willReturn([$groupTag]);
        $this->instance(GroupTagRepositoryContract::class, $groupTagRepository->reveal());

        /** @var FilterTesterContract $filterTester */
        $filterTester = resolve(FilterTester::class);
        $this->assertTrue(
            $filterTester->evaluate($filterInstance)
        );
    }

    /** @test */
    public function it_returns_false_if_the_filter_is_false(){

    }
}
