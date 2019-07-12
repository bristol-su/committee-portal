<?php


namespace Tests\Unit\Support\Module\Module;


use App\Support\Module\Module\ModuleRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Nwidart\Modules\Contracts\RepositoryInterface;
use Nwidart\Modules\Json;
use Nwidart\Modules\Module;
use Tests\TestCase;

class ModuleRepositoryTest extends TestCase
{

    /** @test */
    public function it_scans_for_alias_json_files_in_the_given_path(){
        $filesystem = $this->prophesize(Filesystem::class);
        $filesystem->glob(config('app.module.path').'/*/alias.json')->shouldBeCalled()->willReturn([]);

        $repository = new ModuleRepository($filesystem->reveal());
        $repository->scan();
    }

    /** @test */
    public function it_gets_the_contents_of_each_alias_json_file(){
        $filesystem = $this->prophesize(Filesystem::class);
        $filesystem->glob(config('app.module.path').'/*/alias.json')->shouldBeCalled()->willReturn(['one', 'two']);
        $filesystem->get('one')->shouldBeCalled()->willReturn(json_encode(['alias' => 'aliasone']));
        $filesystem->get('two')->shouldBeCalled()->willReturn(json_encode(['alias' => 'aliastwo']));

        $repository = new ModuleRepository($filesystem->reveal());
        $modules = $repository->scan();

        $this->assertArrayHasKey('aliasone', $modules);
        $this->assertArrayHasKey('aliastwo', $modules);
    }

}