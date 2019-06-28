<?php


namespace Tests\Unit\Support\Module\Module;


use App\Support\Module\Module\ModuleRepository;
use Illuminate\Support\Collection;
use Nwidart\Modules\Contracts\RepositoryInterface;
use Nwidart\Modules\Json;
use Nwidart\Modules\Module;
use Tests\TestCase;

class ModuleRepositoryTest extends TestCase
{

    /** @test */
    public function it_returns_a_collection()
    {
        $repository = new ModuleRepository;

        $this->assertInstanceOf(Collection::class, $repository->all());

    }

    /** @test */
    public function it_gets_the_json_for_each_module()
    {
        $nwidartRepo = $this->prophesize(RepositoryInterface::class);
        $modules = [];
        $json = $this->prophesize(Json::class);
        for ($i = 0; $i < 10; $i++) {
            $module = $this->prophesize(Module::class);
            $module->json()->shouldBeCalled()->willReturn($json->reveal());
            $modules[] = $module->reveal();
        }
        $nwidartRepo->all()->willReturn($modules);

        $this->instance('modules', $nwidartRepo->reveal());

        $moduleRepository = new ModuleRepository;
        $moduleRepository->all();
    }

}