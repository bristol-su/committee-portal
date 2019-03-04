<?php

namespace App\Modules\Budget\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BudgetController extends Controller
{

    public function index() {
        return response('In development.');
    }

}
