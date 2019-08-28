<?php


namespace Tests\Integration\Support\Module\Module;


use App\Support\Module\Module\Module;
use App\Support\Module\Module\ModuleRepository;
use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class ModuleRepositoryTest extends TestCase
{

    /** @test */
    public function it_gets_a_module_by_alias(){
        // TODO Test the correct module is returned
        $moduleRepository = new ModuleRepository(new Filesystem);

        $module = $moduleRepository->findByAlias('fileupload');
        $this->assertInstanceOf(Module::class, $module);
    }

    /** @test */
    public function it_returns_null_if_module_not_found(){
        $moduleRepository = new ModuleRepository(new Filesystem);

        $module = $moduleRepository->findByAlias('invalid');
        $this->assertNull($module);
    }

    /** @test */
    public function it_gets_all_modules(){
        $moduleRepository = new ModuleRepository(new Filesystem);
        $modules = $moduleRepository->all();

        $this->assertIsArray($modules);
        $this->assertArrayHasKey('fileupload', $modules);
        $this->assertInstanceOf(Module::class, $modules['fileupload']);
    }

}
