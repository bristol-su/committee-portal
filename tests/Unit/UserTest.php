<?php


namespace Tests\Unit;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();

    }

    /** @test */
    public function user_without_act_as_admin_permission_is_not_identified_as_an_administrator()
    {
        $this->assertFalse($this->user->isAdmin());
    }

    /** @test */
    public function user_with_act_as_admin_permission_is_identified_as_an_administrator()
    {

        $this->user->givePermissionTo('act-as-admin');

        $this->assertTrue($this->user->isAdmin());

    }

    /** @test */
    public function user_act_as_super_admin_permission_is_not_identified_as_an_administrator()
    {
        $this->assertFalse($this->user->isAdmin());

    }

    /** @test */
    public function user_with_act_as_super_admin_permission_is_identified_as_an_administrator()
    {
        $this->user->givePermissionTo('act-as-super-admin');

        $this->assertTrue($this->user->isAdmin());
    }

}