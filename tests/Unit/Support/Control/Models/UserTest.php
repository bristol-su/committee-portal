<?php


namespace Tests\Unit\Support\Control\Models;


use App\Support\Control\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function id_returns_the_id_of_the_user(){
        $user = new User(['id' => 5]);
        $this->assertEquals(5, $user->id());
    }

    /** @test */
    public function data_platorm_id_returns_the_data_platform_id_of_the_user(){
        $user = new User(['uc_uid' => 'unioncloud_uid']);
        $this->assertEquals('unioncloud_uid', $user->dataPlatformId());
    }



}
