<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Http\Controllers\Controller;
use BristolSU\Support\Connection\Contracts\ConnectionRepository;

class ServiceConnectionController extends Controller
{

    public function index(string $service, ConnectionRepository $connectionRepository)
    {
        return $connectionRepository->getAllForService($service);
    }

}
