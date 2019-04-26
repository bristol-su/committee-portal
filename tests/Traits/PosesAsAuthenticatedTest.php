<?php


namespace Tests\Traits;


use App\User;
use Tests\TestCase;

/**
 * Created since the authentication is reasonably complex
 *
 * Class PosesAsAuthenticatedTest
 * @package Tests\Traits
 */
class PosesAsAuthenticatedTest extends TestCase
{

    /** @test */
    public function it_logs_in_as_a_student(){
        $this->beStudent();
        $this->assertInstanceOf(User::class, $this->identity());
        $this->assertAuthenticatedAs($this->identity(), 'web');
    }

    /** @test */
    public function it_logs_in_as_a_student_without_a_committee_role(){
        $this->beStudent();
        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertNotAuthenticated('committee-role');
    }

    /** @test */
    public function it_logs_in_as_a_student_with_a_committee_role(){
        $this->beStudent()->withRole();

        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertAuthenticatedAs($this->role(), 'committee-role');
    }

    /** @test */
    public function it_logs_in_as_an_admin_without_a_view_as_student_guard(){
        $this->beAdmin();
        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertNotAuthenticated('view-as-student');
    }

    /** @test */
    public function it_logs_in_as_an_admin_with_a_view_as_student_guard(){
        $this->beAdmin()->viewingAsStudent();
        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertAuthenticatedAs($this->role(), 'view-as-student');
    }

    /** @test */
    public function it_logs_in_as_a_super_admin(){
        $this->beSuperAdmin();
        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertNotAuthenticated('view-as-student');
        $this->assertTrue($this->identity()->can('act-as-super-admin'));
    }

    /** @test */
    public function it_logs_in_as_a_super_admin_with_a_view_as_student_guard(){
        $this->beSuperAdmin()->viewingAsStudent();
        $this->assertAuthenticatedAs($this->identity(), 'web');
        $this->assertAuthenticatedAs($this->role(), 'view-as-student');
        $this->assertTrue($this->identity()->can('act-as-super-admin'));

    }

    /** @test */
    public function it_logs_out_of_role()
    {
        $this->beStudent()->withRole();
        $this->assertAuthenticated('committee-role');
        $this->logoutRole();
        $this->assertNotAuthenticated('committee-role');
    }

    /** @test */
    public function it_logs_out_of_identity()
    {
        $this->beStudent();
        $this->assertAuthenticated('web');
        $this->logout();
        $this->assertNotAuthenticated('web');
    }

    /** @test */
    public function it_can_assign_a_single_permission(){
        $this->beStudent()->allowedTo('bypass-maintenance');
        $this->assertTrue($this->identity()->can('bypass-maintenance'));
    }

    /** @test */
    public function it_can_assign_multiple_permissions(){
        $this->beStudent()->allowedTo(['bypass-maintenance', 'view-site-settings-page']);
        $this->assertTrue($this->identity()->can('bypass-maintenance'));
        $this->assertTrue($this->identity()->can('view-site-settings-page'));
    }

    /** @test */
    public function it_can_assign_a_single_permission_after_multiple_chained_methods(){
        $this->beStudent()->withRole()->allowedTo('bypass-maintenance');
        $this->assertTrue($this->identity()->can('bypass-maintenance'));
    }

    /** @test */
    public function it_can_assign_multiple_permissions_after_multiple_chained_methods(){
        $this->beStudent()->withRole()->allowedTo(['bypass-maintenance', 'view-site-settings-page']);
        $this->assertTrue($this->identity()->can('bypass-maintenance'));
        $this->assertTrue($this->identity()->can('view-site-settings-page'));
    }
}