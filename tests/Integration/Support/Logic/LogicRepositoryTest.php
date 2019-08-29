<?php

namespace Tests\Integration\Support\Logic;

use App\Packages\ControlDB\Models\GroupTag;
use App\Support\Logic\Filters\GroupTagged;
use App\Support\Logic\Logic;
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

    /** @test */
    public function it_retrieves_all_logic(){
        $logics = factory(Logic::class, 10)->create();
        $logicRepository = new LogicRepository;
        $allLogics = $logicRepository->all();

        foreach($logics as $logic) {
            $this->assertModelEquals($logic, $allLogics->shift());
        }
    }

}
