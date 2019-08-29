<?php


namespace Tests\Integration\Support\Authentication;


use App\Support\Authentication\LaravelAuthentication;
use App\Support\Control\Models\Group;
use App\Support\Control\Models\Role;
use App\User;
use Tests\TestCase;

class LaravelAuthenticationTest extends TestCase
{

    /**
     * @var LaravelAuthentication
     */
    private $authentication;

    public function setUp() : void
    {
        parent::setUp();
        $this->authentication = resolve(LaravelAuthentication::class);
    }

    /** @test */
    public function get_group_gets_a_group_from_a_role()
    {
        $role = new Role([
            'id' => 1,
            'group' => new Group([
                'id' => 2
            ])
        ]);
        $this->be($role, 'role');

        $this->assertEquals(2, $this->authentication->getGroup()->id);
    }

    /** @test */
    public function get_group_gets_a_group_from_a_group()
    {
        $group = new Group([
            'id' => 2
        ]);
        $this->be($group, 'group');

        $this->assertEquals(2, $this->authentication->getGroup()->id);
    }

    /** @test */
    public function get_group_returns_null_if_not_logged_into_a_group_or_role()
    {
        $this->assertNull($this->authentication->getGroup());
    }

    /** @test */
    public function get_role_gets_role_if_logged_in()
    {
        $role = new Role(['id' => 2]);
        $this->be($role, 'role');

        $this->assertEquals(2, $this->authentication->getRole()->id);
    }

    /** @test */
    public function get_role_returns_null_if_not_logged_into_role()
    {
        $this->assertNull($this->authentication->getRole());
    }

    /** @test */
    public function get_user_returns_a_user_if_logged_into_a_user()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $this->assertModelEquals($user, $this->authentication->getUser());
    }

    /** @test */
    public function get_user_returns_null_if_not_logged_into_a_user()
    {
        $this->assertNull($this->authentication->getUser());
    }

}
