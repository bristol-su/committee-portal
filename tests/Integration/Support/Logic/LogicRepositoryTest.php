<?php

namespace Tests\Integration\Support\Logic;

use App\Packages\ControlDB\Models\GroupTag;
use App\Support\Logic\Filters\GroupTagged;
use App\Support\Logic\LogicRepository;
use Tests\TestCase;

class LogicRepositoryTest extends TestCase
{

    /** @test */
    public function it_creates_a_logic_model_row()
    {
        $logicRepository = new LogicRepository;

        $allTrue = [[
            'class' => GroupTagged::class,
            'setting' => 'reference.ref1'
        ]];
        $anyFalse = [[
            'class' => GroupTagged::class,
            'setting' => 'reference.ref2'
        ], [
            'class' => GroupTagged::class,
            'setting' => 'reference.ref3'
        ]];
        
        $logic = $logicRepository->create('LogicName', 'LogicDescription', $allTrue, [], [], $anyFalse);

        $this->assertDatabaseHas('logics', [
            'name' => 'LogicName',
            'description' => 'LogicDescription',
            'all_true' => json_encode([['class' => GroupTagged::class,'setting' => 'reference.ref1']]),
            'any_true' => json_encode([]),
            'all_false' => json_encode([]),
            'any_false' => json_encode([
                ['class' => GroupTagged::class, 'setting' => 'reference.ref2'],
                ['class' => GroupTagged::class, 'setting' => 'reference.ref3']
            ])
        ]);
    }

}