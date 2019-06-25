<?php

namespace Tests\Unit\Support\Logic\Filters;

use App\Support\Control\Models\Contracts\Group;
use App\Support\Control\Models\Contracts\GroupTag as GroupTagModelContract;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepositoryContract;
use App\Support\Logic\Filters\GroupTagged;
use Tests\TestCase;

class GroupTaggedTest extends TestCase
{

    /** @test */
    public function it_has_a_name(){
        $this->assertEquals('Group Tagged', GroupTagged::name());
    }

    /** @test */
    public function it_has_a_description(){
        $this->assertIsString(GroupTagged::description());
    }

    /** @test */
    public function it_is_valid_for_groups(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $this->assertEquals('group', (new GroupTagged($groupTagRepository->reveal()))->validFor());
    }
    /** @test */
    public function it_returns_a_list_of_options(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);

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

        $groupTagFilter = new GroupTagged($groupTagRepository->reveal());

        $this->assertEquals([
            'reference.ref1' => 'Name1',
            'reference.ref2' => 'Name2'
        ], $groupTagFilter->options());
    }

    /** @test */
    public function it_evaluates_to_true_if_group_tagged(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $group = $this->prophesize(Group::class);

        $groupTag1 = $this->prophesize(GroupTagModelContract::class);
        $groupTag1->fullReference()->shouldBeCalled()->willReturn('reference.ref1');

        $groupTag2 = $this->prophesize(GroupTagModelContract::class);
        $groupTag2->fullReference()->shouldBeCalled()->willReturn('reference.ref2');

        $groupTagRepository->allThroughGroup($group->reveal())->shouldBeCalled()->willReturn([
            $groupTag1->reveal(),
            $groupTag2->reveal()
        ]);

        $groupTagFilter = new GroupTagged($groupTagRepository->reveal());

        $this->assertTrue($groupTagFilter->evaluate($group->reveal(), 'reference.ref2'));
    }

    /** @test */
    public function it_evaluates_to_false_if_group_not_tagged(){
        $groupTagRepository = $this->prophesize(GroupTagRepositoryContract::class);
        $group = $this->prophesize(Group::class);

        $groupTag1 = $this->prophesize(GroupTagModelContract::class);
        $groupTag1->fullReference()->shouldBeCalled()->willReturn('reference.ref1');

        $groupTag2 = $this->prophesize(GroupTagModelContract::class);
        $groupTag2->fullReference()->shouldBeCalled()->willReturn('reference.ref2');

        $groupTagRepository->allThroughGroup($group->reveal())->shouldBeCalled()->willReturn([
            $groupTag1->reveal(),
            $groupTag2->reveal()
        ]);

        $groupTagFilter = new GroupTagged($groupTagRepository->reveal());

        $this->assertFalse($groupTagFilter->evaluate($group->reveal(), 'reference.ref3'));
    }

}