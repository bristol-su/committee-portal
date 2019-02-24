<?php

namespace App\Http\Controllers;

use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function getPositions() {
        $position = Position::all();

        abort_if(!$position, 404, 'Position could not be found');

        return $position;
    }

    public function getPosition(Position $position) {
        return $position;
    }
}

