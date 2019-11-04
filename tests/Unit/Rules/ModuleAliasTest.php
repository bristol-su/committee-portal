<?php


namespace Tests\Unit\Rules;


use App\Rules\ModuleAlias;
use BristolSU\Support\Module\Contracts\Module;
use BristolSU\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use Tests\TestCase;

class ModuleAliasTest extends TestCase
{

    /** @test */
    public function it_passes_with_a_valid_alias(){
        $moduleRepository = $this->prophesize(ModuleRepositoryContract::class);
        $module = $this->prophesize(Module::class);
        $moduleRepository->findByAlias('valid')->willReturn($module->reveal());

        $rule = new ModuleAlias($moduleRepository->reveal());
        $this->assertTrue($rule->passes('alias', 'valid'));
    }

    /** @test */
    public function it_fails_with_an_invalid_alias(){
        $moduleRepository = $this->prophesize(ModuleRepositoryContract::class);
        $moduleRepository->findByAlias('invalid')->willReturn(null);

        $rule = new ModuleAlias($moduleRepository->reveal());
        $this->assertFalse($rule->passes('alias', 'invalid'));
    }
}
