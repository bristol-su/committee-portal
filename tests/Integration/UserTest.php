<?php


namespace Tests\Integration;


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




}