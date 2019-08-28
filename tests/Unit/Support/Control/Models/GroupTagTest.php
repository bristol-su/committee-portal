<?php


namespace Tests\Unit\Support\Control\Models;


use App\Support\Control\Models\GroupTag;
use Tests\TestCase;

class GroupTagTest extends TestCase
{

    /** @test */
    public function name_returns_the_tag_name(){
        $groupTag = new GroupTag(['name' => 'SomeName']);
        $this->assertEquals('SomeName', $groupTag->name());
    }

    /** @test */
    public function full_reference_returns_the_full_reference(){
        $groupTag = new GroupTag([
            'category' => ['reference' => 'category1'],
            'reference' => 'tag1'
        ]);
        $this->assertEquals('category1.tag1', $groupTag->fullReference());
    }

}
