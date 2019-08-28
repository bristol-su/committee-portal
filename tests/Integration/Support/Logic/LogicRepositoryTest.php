<?php

namespace Tests\Integration\Support\Logic;

use App\Packages\ControlDB\Models\GroupTag;
use App\Support\Logic\Filters\GroupTagged;
use App\Support\Logic\LogicRepository;
use Tests\TestCase;

class LogicRepositoryTest extends TestCase
{

    /** @test */
    public function it_creates_a_logic_model()
    {
        $logicRepository = new LogicRepository;

        $logic = $logicRepository->create([
            'name' => 'LogicName',
            'description' => 'LogicDescription',
            'for' => 'group',
        ]);

        $this->assertDatabaseHas('logics', [
            'name' => 'LogicName',
            'description' => 'LogicDescription',
            'for' => 'group',
        ]);
    }

}
