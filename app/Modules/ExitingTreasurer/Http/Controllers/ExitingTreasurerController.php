<?php

namespace App\Modules\ExitingTreasurer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ExitingTreasurerController extends Controller
{
    public function index() {
        return response('In development.');
    }

}
