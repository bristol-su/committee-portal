<?php


namespace App\Support\Module\Registration;


use App\Support\Module\Contracts\ModuleInstanceRepository;
use App\Support\Module\Contracts\OverrideAttribute;
use App\Support\Module\Contracts\OverrideAttributeRepository as OverrideAttributeRepositoryContract;
use App\Support\Module\ModuleInstance\ModuleInstance;

class OverrideAttributeRepository implements OverrideAttributeRepositoryContract
{

    /**
     * @var ModuleInstanceRepository
     */
    private $moduleInstanceRepository;

    public function __construct(ModuleInstanceRepository $moduleInstanceRepository)
    {
        $this->moduleInstanceRepository = $moduleInstanceRepository;
    }

    public function getByModuleInstanceId(int $id): OverrideAttribute
    {
        $moduleInstance = $this->moduleInstanceRepository->getById($id);
        return $moduleInstance->overrideAttribute;
    }
}