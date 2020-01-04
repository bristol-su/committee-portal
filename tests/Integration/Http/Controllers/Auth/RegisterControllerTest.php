<?php

namespace Tests\Integration\Http\Controllers\Auth;

use App\Events\UserVerificationRequestGenerated;
use BristolSU\ControlDB\Models\User as ControlUser;
use BristolSU\ControlDB\Contracts\Repositories\User as ControlUserContract;
use BristolSU\Support\DataPlatform\Contracts\Repositories\User;
use BristolSU\Support\DataPlatform\Contracts\Repositories\User as DataPlatformUserContract;
use BristolSU\Support\DataPlatform\Models\User as DataUser;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;
use Prophecy\Argument;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $dataPlatform = $this->prophesize(DataPlatformUserContract::class);
        $dataPlatform->getByIdentity(Argument::any())->willReturn(new DataUser);
        $this->instance(DataPlatformUserContract::class, $dataPlatform->reveal());

        $controlUserRepository = $this->prophesize(ControlUserContract::class);
        $controlUserRepository->findOrCreateByDataId(Argument::any())->willReturn(new ControlUser());
        $this->instance(ControlUserContract::class, $controlUserRepository->reveal());
    }

    public function register($attributes = [])
    {
        return $this->post('/register', array_merge([
            'identity' => 'tt15951',
            'password' => 'secret123',
            'password_confirmation' => 'secret123'
        ], $attributes));
    }

    /** @test */
    public function it_throws_a_validation_error_if_the_identity_is_not_a_string(){
        $response = $this->register(['identity' => 12345]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('identity');
    }

    /** @test */
    public function it_throws_a_validation_error_if_the_identity_is_null(){
        $response = $this->register(['identity' => null]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('identity');
    }

    /** @test */
    public function it_throws_a_validation_error_if_the_password_is_less_than_six_characters(){
        $response = $this->register(['password' => 'secre', 'password_confirmation' => 'secre']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_throws_a_validation_error_if_no_password_confirmation_field_is_given(){
        $response = $this->register(['password_confirmation' => null]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_throws_a_validation_error_if_the_password_confirmation_does_not_match(){
        $response = $this->register(['password' => 'secret123', 'password_confirmation' => 'secret321']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_throws_a_validation_error_if_the_password_is_null(){
        $response = $this->register(['password' => null, 'password_confirmation' => null]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_returns_back_with_errors_if_the_user_is_not_found_on_unioncloud(){
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willThrow(\Exception::class);
        $this->instance(User::class, $userRepository->reveal());
        $response = $this->register(['identity' => 'tt15951']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('identity');
    }

    /** @test */
    public function it_finds_or_creates_a_user_on_the_control_database()
    {
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(1);
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(1)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());
        $response = $this->register(['identity' => 'tt15951']);
    }

    /** @test */
    public function it_creates_a_user_model(){
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(100);
        $ucUser->forename()->willReturn('Toby');
        $ucUser->surname()->willReturn('Twigger');
        $ucUser->email()->willReturn('tt15951@bristol.ac.uk');
        $ucUser->studentId()->willReturn('tt15951');
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUser->id()->willReturn(2886);
        $controlUser->dataPlatformId()->willReturn(100);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(100)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());
        $response = $this->register(['identity' => 'tt15951']);

        $this->assertDatabaseHas('users', [
            'forename' => 'Toby',
            'surname' => 'Twigger',
            'email' => 'tt15951@bristol.ac.uk',
            'student_id' => 'tt15951',
            'control_id' => 2886
        ]);
    }

    /** @test */
    public function it_sets_a_hashed_password_as_given_in_the_request(){
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(100);
        $ucUser->forename()->willReturn('Toby');
        $ucUser->surname()->willReturn('Twigger');
        $ucUser->email()->willReturn('tt15951@bristol.ac.uk');
        $ucUser->studentId()->willReturn('tt15951');
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUser->id()->willReturn(2886);
        $controlUser->dataPlatformId()->willReturn(100);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(100)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());

        $hash = $this->prophesize(Hasher::class);
        $hash->make('secret123', Argument::any())->shouldBeCalled()->willReturn('secret123-hashed');
        $this->instance('hash', $hash->reveal());

        $response = $this->register(['identity' => 'tt15951', 'password' => 'secret123', 'password_confirmation' => 'secret123']);

        $this->assertDatabaseHas('users', [
            'forename' => 'Toby',
            'surname' => 'Twigger',
            'email' => 'tt15951@bristol.ac.uk',
            'student_id' => 'tt15951',
            'control_id' => 2886,
            'password' => 'secret123-hashed'
        ]);
    }

    /** @test */
    public function it_fires_a_user_request_generated_event(){
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(100);
        $ucUser->forename()->willReturn('Toby');
        $ucUser->surname()->willReturn('Twigger');
        $ucUser->email()->willReturn('tt15951@bristol.ac.uk');
        $ucUser->studentId()->willReturn('tt15951');
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUser->id()->willReturn(2886);
        $controlUser->dataPlatformId()->willReturn(100);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(100)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());

        $this->expectsEvents(UserVerificationRequestGenerated::class);

        $response = $this->register(['identity' => 'tt15951']);

    }

    /** @test */
    public function it_logs_the_new_user_in(){
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(100);
        $ucUser->forename()->willReturn('Toby');
        $ucUser->surname()->willReturn('Twigger');
        $ucUser->email()->willReturn('tt15951@bristol.ac.uk');
        $ucUser->studentId()->willReturn('tt15951');
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUser->id()->willReturn(2886);
        $controlUser->dataPlatformId()->willReturn(100);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(100)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());

        $response = $this->register(['identity' => 'tt15951']);

        $this->assertModelEquals(\BristolSU\Support\User\User::first(), Auth::user());
    }

    /** @test */
    public function it_redirects_to_the_dashboard_on_successful_registration(){
        $ucUser = $this->prophesize(\BristolSU\Support\DataPlatform\Contracts\Models\User::class);
        $ucUser->id()->willReturn(100);
        $ucUser->forename()->willReturn('Toby');
        $ucUser->surname()->willReturn('Twigger');
        $ucUser->email()->willReturn('tt15951@bristol.ac.uk');
        $ucUser->studentId()->willReturn('tt15951');
        $userRepository = $this->prophesize(User::class);
        $userRepository->getByIdentity('tt15951')->shouldBeCalled()->willReturn($ucUser->reveal());
        $this->instance(User::class, $userRepository->reveal());


        $controlUser = $this->prophesize(ControlUser::class);
        $controlUser->id()->willReturn(2886);
        $controlUser->dataPlatformId()->willReturn(100);
        $controlUserRepo = $this->prophesize(\BristolSU\ControlDB\Contracts\Repositories\User::class);
        $controlUserRepo->findOrCreateByDataId(100)->shouldBeCalled()->willReturn($controlUser->reveal());
        $this->instance(\BristolSU\ControlDB\Contracts\Repositories\User::class, $controlUserRepo->reveal());

        $response = $this->register(['identity' => 'tt15951']);

        $response->assertRedirect('/');
    }
}
