<?php

namespace App\Http\Controllers;

use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function getPositions() {
        $position = \App\Packages\ControlDB\Models\Position::all();
        abort_if(!$position, 404);
        return $position->toArray();
    }

    public function getPosition(Position $position) {
        return $position;
    }
}

