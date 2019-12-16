<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Connection\Contracts\ConnectorRepository;

class ConnectorController extends Controller
{

    public function index(ConnectorRepository $connectorRepository)
    {
        return collect($connectorRepository->all())->values();
    }

}
