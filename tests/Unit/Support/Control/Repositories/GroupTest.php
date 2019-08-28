<?php


namespace Tests\Unit\Support\Control\Repositories;


use App\Support\Control\Client\GuzzleClient;
use App\Support\Control\Client\Token;
use App\Support\Control\Contracts\Client\Client;
use App\Support\Control\Repositories\Group;
use Tests\TestCase;

class GroupTest extends TestCase
{

    /** @test */
    public function get_by_id_returns_the_group_with_the_given_id()
    {
        $group = [
            'id' => 1,
            'name' => 'A Group Name',
            'unioncloud_id' => 777,
            'email' => '',
            'created_at' => '2028-01-19 17:26:00',
            'updated_at' => '2028-01-19 17:26:00',
            'deleted_at' => null,
        ];

        $this->mockControl('get', 'groups/' . $group['id'], $group);

        $groupModel = (new Group($this->controlClient->reveal()))->getById($group['id']);
        foreach($group as $attribute => $value) {
            $this->assertEquals($value, $groupModel->{$attribute});
        }
    }

}
