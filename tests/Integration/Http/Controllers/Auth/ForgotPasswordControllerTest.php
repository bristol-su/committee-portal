<?php


namespace Tests\Integration\Http\Controllers\Auth;


use BristolSU\Support\User\User;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{

    /** @test */
    public function it_allows_email_when_resetting_password(){
        $user = factory(User::class)->create();

        $response = $this->post('/password/email', ['identity' => $user->email]);
        $response->assertSessionDoesntHaveErrors('identity');
    }

    /** @test */
    public function it_allows_student_id_when_resetting_password(){
        $user = factory(User::class)->create();

        $response = $this->post('/password/email', ['identity' => $user->student_id]);
        $response->assertSessionDoesntHaveErrors('identity');
    }

    /** @test */
    public function view_has_error_key_identity_if_something_goes_wrong(){
        $response = $this->post('/password/email', ['identity' => 'NotARealIdentity']);
        $response->assertSessionHasErrors('identity');
    }

}
