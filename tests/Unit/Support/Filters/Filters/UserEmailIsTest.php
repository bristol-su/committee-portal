<?php


namespace Tests\Unit\Support\Filters\Filters;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Filters\Filters\UserEmailIs;
use App\User;
use Tests\TestCase;

class UserEmailIsTest extends TestCase
{

    /** @test */
    public function options_returns_a_blank_string_for_email(){
        $authentication = $this->prophesize(Authentication::class);
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertEquals(['email' => ''], $filter->options());
    }

    /** @test */
    public function evaluate_returns_true_if_a_user_email_is_equal_to_the_settings(){
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn(new User(['email' => 'tt15951@example.com']));
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertTrue($filter->evaluate(['email' => 'tt15951@example.com']));
    }

    /** @test */
    public function evaluate_returns_false_if_a_user_email_is_not_equal_to_the_settings(){
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getUser()->shouldBeCalled()->willReturn(new User(['email' => 'tt15951@example.com']));
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertFalse($filter->evaluate(['email' => 'tt15951@nothesame.com']));
    }

    /** @test */
    public function name_returns_the_filter_name(){
        $authentication = $this->prophesize(Authentication::class);
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertEquals('User has Email', $filter->name());
    }

    /** @test */
    public function description_returns_the_filter_description(){
        $authentication = $this->prophesize(Authentication::class);
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertEquals('User has a given email address', $filter->description());
    }

    /** @test */
    public function alias_returns_the_filter_alias(){
        $authentication = $this->prophesize(Authentication::class);
        $filter = new UserEmailIs($authentication->reveal());

        $this->assertEquals('user_email', $filter->alias());
    }

}
