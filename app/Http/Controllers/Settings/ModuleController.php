<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
    /**
     * @var ModuleRepositoryContract
     */
    private $moduleRepository;

    public function __construct(ModuleRepositoryContract $moduleRepository)
    {

        $this->moduleRepository = $moduleRepository;
    }

    public function index()
    {
        return $this->moduleRepository->all();
    }
}
