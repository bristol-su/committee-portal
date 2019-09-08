<?php

namespace App\Support\Module;

use App\Support\Completion\ConfigCompletionEventRepository;
use App\Support\Completion\Contracts\CompletionEventRepository;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use App\Support\Permissions\Contracts\PermissionRepository;
use Illuminate\Filesystem\Filesystem;

class ModuleRepository implements ModuleRepositoryContract
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function all()
    {
        return $this->scan();
    }

    public function findByAlias($alias)
    {
        $modules = $this->scan();
        return (array_key_exists($alias, $modules)?$modules[$alias]:null);
    }

    public function scan()
    {
        $modules = [];

        $moduleJsons = $this->filesystem->glob(config('app.module.path').'/*/alias.json');
        foreach ($moduleJsons as $json) {
            $alias = json_decode($this->filesystem->get($json))->alias;
            $modules[$alias] = new \App\Support\Module\Module($alias, config(), resolve(CompletionEventRepository::class), resolve(PermissionRepository::class));
        }

        return $modules;
    }

}
