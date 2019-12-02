<?php

namespace App\Http\Controllers\Api\Control;

use App\Http\Controllers\Controller;
use BristolSU\Support\Control\Contracts\Repositories\Position as PositionRepository;

class PositionController extends Controller
{

    public function show($positionId, PositionRepository $positionRepository)
    {
        return $positionRepository->getById($positionId);
    }

}
