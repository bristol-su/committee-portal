<?php


namespace Tests\Unit\Support\Logic\Specification;


use App\Support\Logic\Contracts\Specification as SpecificationContract;
use App\Support\Logic\Specification\AndSpecification;
use Tests\TestCase;

class AndSpecificationTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_all_specifications_are_met(){
        $spec1 = $this->prophesize(SpecificationContract::class);
        $spec2 = $this->prophesize(SpecificationContract::class);
        $spec3 = $this->prophesize(SpecificationContract::class);

        $spec1->isSatisfied()->shouldBeCalled()->willReturn(true);
        $spec2->isSatisfied()->shouldBeCalled()->willReturn(true);
        $spec3->isSatisfied()->shouldBeCalled()->willReturn(true);

        $specification = new AndSpecification($spec1->reveal(), $spec2->reveal(), $spec3->reveal());

        $this->assertTrue($specification->isSatisfied());
    }

    /** @test */
    public function it_returns_false_if_a_specification_is_not_met(){
        $spec1 = $this->prophesize(SpecificationContract::class);
        $spec2 = $this->prophesize(SpecificationContract::class);
        $spec3 = $this->prophesize(SpecificationContract::class);

        $spec1->isSatisfied()->shouldBeCalled()->willReturn(true);
        $spec2->isSatisfied()->shouldBeCalled()->willReturn(false);
        $spec3->isSatisfied()->shouldNotBeCalled();

        $specification = new AndSpecification($spec1->reveal(), $spec2->reveal(), $spec3->reveal());

        $this->assertFalse($specification->isSatisfied());
    }
    
    /** @test */
    public function it_returns_true_if_there_are_no_specifications(){
        $specification = new AndSpecification;

        $this->assertTrue($specification->isSatisfied());
    }
    
}