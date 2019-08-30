<?php


namespace Tests\Unit\Support\Control\Repositories;


use App\Support\Control\Contracts\Client\Client;
use App\Support\Control\Repositories\User;
use Prophecy\Argument;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function find_or_create_by_data_id_tries_to_get_user_by_data_provider_id()
    {
        $this->mockControl('post', 'students/search', [['uc_uid'=>2845746]]);

        $userRepository = new User($this->controlClient->reveal());
        $userRepository->findOrCreateByDataId(2845746);
    }

    /** @test */
    public function find_or_create_by_data_id_returns_a_user_if_given(){
        $this->mockControl('post', 'students/search', [['uc_uid'=>2845746]]);

        $userRepository = new User($this->controlClient->reveal());
        $user = $userRepository->findOrCreateByDataId(2845746);

        $this->assertEquals(2845746, $user->dataPlatformId());
    }

    /** @test */
    public function find_or_create_by_data_id_creates_a_control_user_if_not_found(){
        $client = $this->prophesize(Client::class);
        $client->request('post', 'students', Argument::that(function($arg){
            return $arg['form_params'] === ['uc_uid' => 2845746];
        }))->shouldBeCalled()->willReturn(['uc_uid' => 2845746]);

        $userRepository = new User($client->reveal());
        $user = $userRepository->findOrCreateByDataId(2845746);

        $this->assertEquals(2845746, $user->dataPlatformId());
    }

}
