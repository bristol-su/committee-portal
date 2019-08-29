<?php


namespace Tests\Unit\Support\DataPlatform\Models;


use App\Support\DataPlatform\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function id_returns_the_id_of_the_user(){
        $user = new User(['uid' => 5]);
        $this->assertEquals(5, $user->id());
    }

    /** @test */
    public function forename_returns_the_forename_of_the_user(){
        $user = new User(['forename' => 'Toby']);
        $this->assertEquals('Toby', $user->forename());
    }

    /** @test */
    public function surname_returns_the_surname_of_the_user(){
        $user = new User(['surname' => 'Twigger']);
        $this->assertEquals('Twigger', $user->surname());
    }

    /** @test */
    public function email_returns_the_email_of_the_user(){
        $user = new User(['email' => 'toby.twigger@bristol.ac.uk']);
        $this->assertEquals('toby.twigger@bristol.ac.uk', $user->email());
    }

    /** @test */
    public function student_id_returns_the_student_id_of_the_user(){
        $user = new User(['studentId' => 'tt15951']);
        $this->assertEquals('tt15951', $user->studentId());
    }
}
