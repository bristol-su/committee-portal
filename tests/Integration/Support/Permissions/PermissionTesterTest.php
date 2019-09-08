<?php


namespace Tests\Integration\Support\Permissions;


use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\PermissionTester;
use Tests\TestCase;

class PermissionTesterTest extends TestCase
{

    /** @test */
    public function getChain_throws_an_exception_if_no_testers(){
        $this->expectException(\Exception::class);
        $permissionTester = new PermissionTester;
        $permissionTester->getChain();
    }

    /** @test */
    public function getChain_returns_a_single_tester_if_one_tester_registered(){
        $tester1 = $this->prophesize(Tester::class);
        $permissionTester = new PermissionTester();
        $permissionTester->register($tester1->reveal());

        $this->assertEquals($tester1->reveal(), $permissionTester->getChain());
    }

    /** @test */
    public function getChain_returns_a_single_tester_if_multiple_testers_registered(){
        $tester1 = $this->prophesize(Tester::class);
        $tester2 = $this->prophesize(Tester::class);
        $permissionTester = new PermissionTester();
        $permissionTester->register($tester1->reveal());
        $permissionTester->register($tester2->reveal());

        $this->assertInstanceOf(Tester::class, $permissionTester->getChain());
    }

    /** @test */
    public function getChain_sets_a_chain(){
        $tester1 = $this->prophesize(Tester::class);
        $tester2 = $this->prophesize(Tester::class);
        $tester3 = $this->prophesize(Tester::class);
        $tester4 = $this->prophesize(Tester::class);
        $tester1->setNext($tester2->reveal())->shouldBeCalled();
        $tester2->setNext($tester3->reveal())->shouldBeCalled();
        $tester3->setNext($tester4->reveal())->shouldBeCalled();

        $permissionTester = new PermissionTester();
        $permissionTester->register($tester1->reveal());
        $permissionTester->register($tester2->reveal());
        $permissionTester->register($tester3->reveal());
        $permissionTester->register($tester4->reveal());

        $this->assertEquals($tester1->reveal(), $permissionTester->getChain());
    }

    /** @test */
    public function evaluate_returns_true_if_the_tester_is_true(){
        $tester = $this->prophesize(Tester::class);
        $tester->can('ability')->shouldBeCalled()->willReturn(true);

        $permissionTester = new PermissionTester;
        $permissionTester->register($tester->reveal());

        $this->assertTrue(
            $permissionTester->evaluate('ability')
        );
    }

    /** @test */
    public function evaluate_returns_false_if_the_tester_is_false(){
        $tester = $this->prophesize(Tester::class);
        $tester->can('ability')->shouldBeCalled()->willReturn(false);

        $permissionTester = new PermissionTester;
        $permissionTester->register($tester->reveal());

        $this->assertFalse(
            $permissionTester->evaluate('ability')
        );
    }

    /** @test */
    public function evaluate_returns_false_if_null_returned_from_can(){
        $tester = $this->prophesize(Tester::class);
        $tester->can('ability')->shouldBeCalled()->willReturn(null);

        $permissionTester = new PermissionTester;
        $permissionTester->register($tester->reveal());

        $this->assertFalse(
            $permissionTester->evaluate('ability')
        );
    }

    /** @test */
    public function evaluate_tries_each_class_until_one_returns_a_boolean(){
        $tester1 = (new DummyTester())->returnNull();
        $tester2 = (new DummyTester())->return(true);

        $permissionTester = new PermissionTester;
        $permissionTester->register($tester1);
        $permissionTester->register($tester2);

        $this->assertTrue(
            $permissionTester->evaluate('')
        );
    }


    /** @test */
    public function evaluate_returns_false_if_no_successor_given(){
        $tester1 = (new DummyTester())->returnNull();

        $permissionTester = new PermissionTester;
        $permissionTester->register($tester1);

        $this->assertFalse(
            $permissionTester->evaluate('')
        );
    }


}

class DummyTester extends Tester
{

    private $return = null;

    public function returnNull()
    {
        $this->return = null;
        return $this;
    }

    public function return($bool) {
        $this->return = $bool;
        return $this;
    }

    public function can(string $ability): ?bool
    {
        if($this->return === null) {
            return parent::next($ability);
        }
        return $this->return;
    }
}
