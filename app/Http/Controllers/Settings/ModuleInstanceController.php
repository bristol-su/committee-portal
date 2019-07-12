<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\ModuleInstanceController\StoreModuleInstanceRequest;
use App\Support\Module\Contracts\ModuleInstanceRepository;
use App\Http\Controllers\Controller;

class ModuleInstanceController extends Controller
{
    /**
     * @var ModuleInstanceRepository
     */
    private $moduleInstanceRepository;

    public function __construct(ModuleInstanceRepository $moduleInstanceRepository)
    {

        $this->moduleInstanceRepository = $moduleInstanceRepository;
    }

    public function store(StoreModuleInstanceRequest $request)
    {
        return $this->moduleInstanceRepository->create(
            $request->all()
        );

    }


}
