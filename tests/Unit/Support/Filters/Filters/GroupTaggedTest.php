<?php


namespace Tests\Unit\Support\Filters\Filters;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Control\Contracts\Models\Group;
use App\Support\Control\Contracts\Models\GroupTag as GroupTagModelContract;
use App\Support\Control\Contracts\Repositories\GroupTag as GroupTagRepositoryContract;
use App\Support\Filters\Filters\GroupTagged;
use Tests\TestCase;

class GroupTaggedTest extends TestCase
{

    /** @test */
    public function it_returns_a_list_of_possible_tags(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $authentication = $this->prophesize(Authentication::class);

        $groupTag1 = $this->prophesize(GroupTagModelContract::class);
        $groupTag1->name()->shouldBeCalled()->willReturn('Name1');
        $groupTag1->fullReference()->shouldBeCalled()->willReturn('reference.ref1');

        $groupTag2 = $this->prophesize(GroupTagModelContract::class);
        $groupTag2->name()->shouldBeCalled()->willReturn('Name2');
        $groupTag2->fullReference()->shouldBeCalled()->willReturn('reference.ref2');

        $groupTagRepository->all()->shouldBeCalled()->willReturn([
            $groupTag1->reveal(),
            $groupTag2->reveal()
        ]);

        $groupTagFilter = new GroupTagged($authentication->reveal(), $groupTagRepository->reveal());

        $this->assertEquals([
            'tag' => [
                'reference.ref1' => 'Name1',
                'reference.ref2' => 'Name2'
            ]
            ], $groupTagFilter->options());
    }

    /** @test */
    public function it_evaluates_to_true_if_group_tagged(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $authentication = $this->prophesize(Authentication::class);

        $group = $this->prophesize(Group::class);
        $authentication->getGroup()->shouldBeCalled()->willReturn($group->reveal());

        $groupTag1 = $this->prophesize(GroupTagModelContract::class);
        $groupTag1->fullReference()->shouldBeCalled()->willReturn('reference.ref1');

        $groupTag2 = $this->prophesize(GroupTagModelContract::class);
        $groupTag2->fullReference()->shouldBeCalled()->willReturn('reference.ref2');

        $groupTagRepository->allThroughGroup($group->reveal())->shouldBeCalled()->willReturn([
            $groupTag1->reveal(),
            $groupTag2->reveal()
        ]);

        $groupTagFilter = new GroupTagged($authentication->reveal(), $groupTagRepository->reveal());

        $this->assertTrue($groupTagFilter->evaluate(['tag' => 'reference.ref2']));
    }

    /** @test */
    public function it_evaluates_to_false_if_group_not_tagged(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $authentication = $this->prophesize(Authentication::class);

        $group = $this->prophesize(Group::class);
        $authentication->getGroup()->shouldBeCalled()->willReturn($group->reveal());

        $groupTag1 = $this->prophesize(GroupTagModelContract::class);
        $groupTag1->fullReference()->shouldBeCalled()->willReturn('reference.ref1');

        $groupTag2 = $this->prophesize(GroupTagModelContract::class);
        $groupTag2->fullReference()->shouldBeCalled()->willReturn('reference.ref2');

        $groupTagRepository->allThroughGroup($group->reveal())->shouldBeCalled()->willReturn([
            $groupTag1->reveal(),
            $groupTag2->reveal()
        ]);

        $groupTagFilter = new GroupTagged($authentication->reveal(), $groupTagRepository->reveal());

        $this->assertFalse($groupTagFilter->evaluate(['tag' => 'reference.ref3']));
    }
}
