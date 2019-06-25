<?php


namespace Tests\Unit\Support\Logic\Specification;


use App\Support\Logic\Contracts\Specification as SpecificationContract;
use App\Support\Logic\Specification\OrSpecification;
use Tests\TestCase;

class OrSpecificationTest extends TestCase
{

    /** @test */
    public function it_returns_true_if_any_specifications_are_met(){
        $spec1 = $this->prophesize(SpecificationContract::class);
        $spec2 = $this->prophesize(SpecificationContract::class);
        $spec3 = $this->prophesize(SpecificationContract::class);

        $spec1->isSatisfied()->shouldBeCalled()->willReturn(false);
        $spec2->isSatisfied()->shouldBeCalled()->willReturn(true);
        $spec3->isSatisfied()->shouldNotBeCalled();

        $specification = new OrSpecification($spec1->reveal(), $spec2->reveal(), $spec3->reveal());

        $this->assertTrue($specification->isSatisfied());
    }

    /** @test */
    public function it_returns_false_if_no_specifications_are_met(){
        $spec1 = $this->prophesize(SpecificationContract::class);
        $spec2 = $this->prophesize(SpecificationContract::class);
        $spec3 = $this->prophesize(SpecificationContract::class);

        $spec1->isSatisfied()->shouldBeCalled()->willReturn(false);
        $spec2->isSatisfied()->shouldBeCalled()->willReturn(false);
        $spec3->isSatisfied()->shouldBeCalled()->willReturn(false);

        $specification = new OrSpecification($spec1->reveal(), $spec2->reveal(), $spec3->reveal());

        $this->assertFalse($specification->isSatisfied());
    }
    
    /** @test */
    public function it_returns_true_if_there_are_no_specifications(){
        $specification = new OrSpecification;

        $this->assertTrue($specification->isSatisfied());
    }
    
}