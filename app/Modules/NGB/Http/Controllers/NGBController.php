<?php

namespace App\Modules\NGB\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class NGBController extends Controller
{
    public function index() {
        return response('In development.');
    }

}
