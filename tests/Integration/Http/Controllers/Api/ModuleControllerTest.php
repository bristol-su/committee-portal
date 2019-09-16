<?php


namespace Tests\Integration\Http\Controllers\Api;


use BristolSU\Support\Module\Contracts\ModuleRepository;
use BristolSU\Support\Module\Module;
use BristolSU\Support\User\User;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ModuleControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user, 'api');
    }
    /** @test */
    public function index_calls_get_all_from_the_module_repository(){
        $modules = [];
        for ($i=0; $i < 5;$i++) {
            $module = $this->prophesize(Module::class);
            $module->toArray()->shouldBeCalled()->willReturn([
                'alias' => 'alias1'
            ]);
            $modules[] = $module;
        }

        $moduleRepository = $this->prophesize(ModuleRepository::class);
        $moduleRepository->all()->shouldBeCalled()->willReturn($modules);
        $this->instance(ModuleRepository::class, $moduleRepository->reveal());

        $response = $this->json('get', '/api/module');
    }

    /** @test */
    public function index_returns_all_modules_as_arrays(){
        $modules = new Collection;
        $responseValue = [];
        for ($i=0; $i < 5;$i++) {
            $module = $this->prophesize(Module::class);
            $module->toArray()->shouldBeCalled()->willReturn([
                'alias' => 'alias1',
            ]);
            $modules->push($module->reveal());
            $responseValue[] = [
                'alias' => 'alias1',
            ];
        }

        $moduleRepository = $this->prophesize(ModuleRepository::class);
        $moduleRepository->all()->shouldBeCalled()->willReturn($modules);
        $this->instance(ModuleRepository::class, $moduleRepository->reveal());

        $response = $this->json('get', '/api/module');
        $response->assertExactJson($responseValue);
    }

}
