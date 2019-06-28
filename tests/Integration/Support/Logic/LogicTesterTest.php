<?php

namespace Tests\Integration\Support\Logic;

use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Models\Contracts\Group;
use App\Support\Logic\AuthenticationModelFactory;
use App\Support\Logic\FilterFactory;
use App\Support\Logic\Filters\GroupTagged;
use App\Support\Logic\Logic;
use App\Support\Logic\LogicTester;
use Tests\TestCase;

class LogicTesterTest extends TestCase
{


    /** @test */
    public function it_returns_true_when_all_fields_match_what_they_should_do(){

        $logic = factory(Logic::class, [
            'name' => 'Logic Name',
            'description' => 'Description',
            'all_true' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.true']
            ],
            'any_true' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
            'all_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.false'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
            'any_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
        ])->create()->first();

        $authentication = $this->prophesize(AuthenticationContract::class);
        $group = $this->prophesize(Group::class);
        $filter = $this->prophesize(GroupTagged::class);

        $authentication->getGroup()->willReturn($group->reveal());

        $filter->validFor()->willReturn('group');
        $filter->evaluate($group->reveal(), 'reference.true')->willReturn(true);
        $filter->evaluate($group->reveal(), 'reference.false')->willReturn(false);
        $this->instance(GroupTagged::class, $filter->reveal());

        $logicTester = new LogicTester(new FilterFactory, new AuthenticationModelFactory($authentication->reveal()));



        $this->assertTrue($logicTester->evaluate($logic));
    }

    /** @test */
    public function it_returns_true_when_an_any_field_is_empty_array(){
        $logic = factory(Logic::class, [
            'name' => 'Logic Name',
            'description' => 'Description',
            'all_true' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.true']
            ],
            'any_true' => [],
            'all_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.false'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
            'any_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
        ])->create()->first();

        $authentication = $this->prophesize(AuthenticationContract::class);
        $group = $this->prophesize(Group::class);
        $filter = $this->prophesize(GroupTagged::class);

        $authentication->getGroup()->willReturn($group->reveal());

        $filter->validFor()->willReturn('group');
        $filter->evaluate($group->reveal(), 'reference.true')->willReturn(true);
        $filter->evaluate($group->reveal(), 'reference.false')->willReturn(false);
        $this->instance(GroupTagged::class, $filter->reveal());

        $logicTester = new LogicTester(new FilterFactory, new AuthenticationModelFactory($authentication->reveal()));



        $this->assertTrue($logicTester->evaluate($logic));
    }

    /** @test */
    public function it_returns_true_when_an_all_field_is_empty_array(){
        $logic = factory(Logic::class, [
            'name' => 'Logic Name',
            'description' => 'Description',
            'all_true' => [],
            'any_true' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
            'all_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.false'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
            'any_false' => [
                ['class' => GroupTagged::class, 'setting' => 'reference.true'],
                ['class' => GroupTagged::class, 'setting' => 'reference.false']
            ],
        ])->create()->first();

        $authentication = $this->prophesize(AuthenticationContract::class);
        $group = $this->prophesize(Group::class);
        $filter = $this->prophesize(GroupTagged::class);

        $authentication->getGroup()->willReturn($group->reveal());

        $filter->validFor()->willReturn('group');
        $filter->evaluate($group->reveal(), 'reference.true')->willReturn(true);
        $filter->evaluate($group->reveal(), 'reference.false')->willReturn(false);
        $this->instance(GroupTagged::class, $filter->reveal());

        $logicTester = new LogicTester(new FilterFactory, new AuthenticationModelFactory($authentication->reveal()));



        $this->assertTrue($logicTester->evaluate($logic));
    }

    /** @test */
    public function it_returns_true_when_all_fields_empty_array(){
        $logic = factory(Logic::class, [
            'name' => 'Logic Name',
            'description' => 'Description',
            'all_true' => [],
            'any_true' => [],
            'all_false' => [],
            'any_false' => [],
        ])->create()->first();

        $authentication = $this->prophesize(AuthenticationContract::class);
        $group = $this->prophesize(Group::class);
        $filter = $this->prophesize(GroupTagged::class);

        $authentication->getGroup()->willReturn($group->reveal());

        $filter->validFor()->willReturn('group');
        $filter->evaluate($group->reveal(), 'reference.true')->willReturn(true);
        $filter->evaluate($group->reveal(), 'reference.false')->willReturn(false);
        $this->instance(GroupTagged::class, $filter->reveal());

        $logicTester = new LogicTester(new FilterFactory, new AuthenticationModelFactory($authentication->reveal()));



        $this->assertTrue($logicTester->evaluate($logic));
    }
}