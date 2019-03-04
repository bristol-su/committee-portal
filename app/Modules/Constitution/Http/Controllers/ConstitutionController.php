<?php

namespace App\Modules\Constitution\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ConstitutionController extends Controller
{
    public function index() {
        return response('In development.');
    }

}
