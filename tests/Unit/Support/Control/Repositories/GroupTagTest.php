<?php


namespace Tests\Unit\Support\Control\Repositories;


use App\Support\Control\Models\Group;
use App\Support\Control\Repositories\GroupTag;
use Tests\TestCase;

class GroupTagTest extends TestCase
{

    /** @test */
    public function all_gets_all_group_tags(){
        $groupTags = [
            ['id' => 1, 'reference' => 'something'],
            ['id' => 2, 'reference' => 'sthelse']
        ];

        $this->mockControl('get', 'group_tags', $groupTags);

        $groupTagModels = (new GroupTag($this->controlClient->reveal()))->all();
        $this->assertCount(2, $groupTagModels);
        $this->assertEquals(1, $groupTagModels[0]->id);
        $this->assertEquals(2, $groupTagModels[1]->id);
    }

    /** @test */
    public function all_returns_an_empty_array_if_no_group_tags_found(){
        $this->mockControl('get', 'group_tags', []);

        $groupTagModels = (new GroupTag($this->controlClient->reveal()))->all();
        $this->assertEquals([], $groupTagModels);
    }

    /** @test */
    public function all_through_group_returns_all_tags_in_the_given_group(){
        $groupTags = [
            ['id' => 1, 'reference' => 'something'],
            ['id' => 2, 'reference' => 'sthelse']
        ];

        $this->mockControl('get', 'groups/1/group_tags', $groupTags);

        $groupTagModels = (new GroupTag($this->controlClient->reveal()))->allThroughGroup(new Group(['id' => 1]));
        $this->assertCount(2, $groupTagModels);
        $this->assertEquals(1, $groupTagModels[0]->id);
        $this->assertEquals(2, $groupTagModels[1]->id);
    }

    /** @test */
    public function all_through_group_returns_an_empty_array_if_no_tags_found(){
        $this->mockControl('get', 'groups/1/group_tags', []);

        $groupTagModels = (new GroupTag($this->controlClient->reveal()))->allThroughGroup(new Group(['id' => 1]));
        $this->assertEquals([], $groupTagModels);
    }

}
