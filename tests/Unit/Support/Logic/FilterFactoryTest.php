<?php


namespace Tests\Unit\Support\Logic;


use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepository;
use App\Support\Logic\Contracts\FilterFactory as FilterFactoryContract;
use App\Support\Logic\FilterFactory;
use App\Support\Logic\Filters\GroupTagged;
use App\Support\Logic\LogicTester;
use Tests\TestCase;

class FilterFactoryTest extends TestCase
{
    /** @test */
    public function it_creates_a_new_instance_of_a_class(){
        $className = 'group_tagged';
        $this->instance(GroupTagRepository::class, $this->prophesize(GroupTagRepository::class)->reveal());

        $filterFactory = new FilterFactory;
        $this->assertInstanceOf(GroupTagged::class, $filterFactory->create($className));

    }
}