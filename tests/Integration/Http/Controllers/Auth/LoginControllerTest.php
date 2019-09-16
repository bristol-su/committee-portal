<?php

namespace Tests\Integration\Http\Controllers\Auth;

use BristolSU\Support\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    /** @test */
    public function it_logs_in_a_user_given_an_email_as_an_identity(){
        $user = factory(User::class)->create([
            'email' => 'tt15951@bristol.ac.uk',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->post('/login', [
            'identity' => 'tt15951@bristol.ac.uk',
            'password' => 'secret123'
        ]);

        $this->assertInstanceOf(User::class, Auth::user());
        $this->assertModelEquals(Auth::user(), $user);
    }

    /** @test */
    public function it_logs_in_a_user_given_a_student_id_as_an_identity(){
        $user = factory(User::class)->create([
            'student_id' => 'tt15951',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->post('/login', [
            'identity' => 'tt15951',
            'password' => 'secret123'
        ]);

        $this->assertInstanceOf(User::class, Auth::user());
        $this->assertModelEquals(Auth::user(), $user);
    }

    /** @test */
    public function it_returns_an_error_if_the_user_is_not_found(){
        $response = $this->post('/login', [
            'identity' => 'tt15951@bristol.ac.uk',
            'password' => 'secret123'
        ]);

        $response->assertSessionHasErrors('identity');
        $this->assertNull(Auth::user());
    }

    /** @test */
    public function it_returns_an_error_if_the_password_is_wrong(){
        $user = factory(User::class)->create([
            'email' => 'tt15951@bristol.ac.uk',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->post('/login', [
            'identity' => 'tt15951@bristol.ac.uk',
            'password' => 'secret1234'
        ]);

        $response->assertSessionHasErrors('identity');
        $this->assertNull(Auth::user());
    }

}
