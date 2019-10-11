<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Action\Contracts\ActionRepository;

class ActionController extends Controller
{

    public function index(ActionRepository $actionRepository)
    {
        return $actionRepository->all();
    }
}
