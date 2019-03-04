<?php

namespace App\Modules\StrategicPlan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StrategicPlanController extends Controller
{
    public function index() {
        return response('In development.');
    }

}
