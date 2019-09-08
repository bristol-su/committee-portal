<?php

namespace Tests\Integration\Support\ModuleInstance\Middleware;

use App\Support\ModuleInstance\Middleware\InjectModuleInstance;
use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Prophecy\Argument;
use Tests\TestCase;

class InjectModuleInstanceTest extends TestCase
{

    /** @test */
    public function it_passes_the_module_in_the_request_to_the_container(){
        $moduleInstance = factory(ModuleInstance::class)->create();
        $request = $this->prophesize(Request::class);
        $request->route('module_instance_slug')->shouldBeCalled()->willReturn($moduleInstance);

        $app = $this->prophesize(Container::class);
        $app->instance(ModuleInstance::class, Argument::that(function($arg) use ($moduleInstance) {
            return $arg->id === $moduleInstance->id;
        }))->shouldBeCalled();

        $middleware = new InjectModuleInstance($app->reveal());
        $middleware->handle($request->reveal(), function($request) {

        });

    }

}
