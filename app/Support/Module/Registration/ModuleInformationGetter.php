<?php

namespace App\Support\Module\Registration;

use App\Support\Module\Contracts\ModuleInstance;
use App\Support\Module\Contracts\OverrideAttributeRepository;

class ModuleInformationGetter
{

    private $overrideAttributeRepository;

    public function __construct(OverrideAttributeRepository $overrideAttributeRepository)
    {

        $this->overrideAttributeRepository = $overrideAttributeRepository;
    }

    public function get(ModuleInstance $moduleInstance)
    {
        $attributes = config($moduleInstance->alias() . '.registration');
        $overrideAttributes = $this->overrideAttributeRepository->getByModuleInstanceId($moduleInstance->id())->toArray();

        return array_merge($attributes, $overrideAttributes);
    }

}