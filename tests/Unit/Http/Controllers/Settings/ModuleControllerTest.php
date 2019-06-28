<?php


namespace Tests\Unit\Http\Controllers\Settings;


use App\Http\Controllers\Settings\ModuleController;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use Tests\TestCase;

class ModuleControllerTest extends TestCase
{

    /** @test */
    public function it_calls_the_all_function_of_the_module_repository(){
        $moduleRepository = $this->prophesize(ModuleRepositoryContract::class);
        $moduleRepository->all()->shouldBeCalled();

        $controller = new ModuleController($moduleRepository->reveal());
        $controller->index();
    }

    /** @test */
    public function it_returns_the_return_value_of_the_repository(){
        $returnValue = '{"test": "ok"}';
        $moduleRepository = $this->prophesize(ModuleRepositoryContract::class);
        $moduleRepository->all()->shouldBeCalled()->willReturn($returnValue);

        $controller = new ModuleController($moduleRepository->reveal());
        $response = $controller->index();

        $this->assertEquals($returnValue, $response);
    }

}