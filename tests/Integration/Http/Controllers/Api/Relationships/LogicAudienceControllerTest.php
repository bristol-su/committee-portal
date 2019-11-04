<?php

namespace Tests\Integration\Http\Controllers\Api\Relationships;

use BristolSU\Support\Logic\Contracts\LogicAudience;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\User\User;
use Prophecy\Argument;
use Tests\TestCase;

class LogicAudienceControllerTest extends TestCase
{
    /** @test */
    public function index_calls_the_audience_function(){
        $logic = factory(Logic::class)->create();
        $logicAudience = $this->prophesize(LogicAudience::class);
        $logicAudience->audience(Argument::that(function($arg) use ($logic) {
            return $arg->id === $logic->id;
        }))->shouldBeCalled()->willReturn([]);

        $this->instance(LogicAudience::class, $logicAudience->reveal());

        $response = $this->get('/api/logic/' . $logic->id . '/audience');

        $response->assertJson([]);
    }

}
