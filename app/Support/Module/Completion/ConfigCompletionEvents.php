<?php

namespace App\Support\Module\Completion;

use App\Support\Module\Contracts\CompletionEvents;
use App\Support\Module\Contracts\ModuleRepository;

class ConfigCompletionEvents implements CompletionEvents
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {

        $this->moduleRepository = $moduleRepository;
    }

    public function exists($event): bool
    {

    }

    public function all()
    {
        foreach($this->moduleRepository->all() as $module) {

        }
    }
}