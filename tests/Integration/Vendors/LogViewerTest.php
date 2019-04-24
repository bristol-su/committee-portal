<?php


namespace Tests\Integration\Vendors;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogViewerTest extends TestCase
{

    /** @test */
    public function it_allows_access_to_an_administrator_with_the_view_php_logs_permission(){
        $this->beAdmin()->allowedTo('view-php-logs');
        $this->assertNotEquals(403, $this->get('php-logs')->status());
    }

    /** @test */
    public function it_denies_access_to_an_administrator_without_the_view_php_logs_permission(){
        $this->beAdmin();
        $this->get('php-logs')->assertStatus(403);
    }

    /** @test */
    public function it_denies_access_to_a_student_without_the_view_php_logs_permission(){
        $this->beStudent();
        $this->get('php-logs')->assertStatus(403);
    }

    /** @test */
    public function it_denies_access_to_a_student_with_the_view_php_logs_permission(){
        $this->beStudent()->allowedTo('view-php-logs');
        $this->get('php-logs')->assertStatus(403);
    }

    /** @test */
    public function it_is_accessible_at_the_given_url(){
        $this->beAdmin()->allowedTo('view-php-logs');

        $this->get('php-logs')
            ->assertStatus(200);
    }
    
}