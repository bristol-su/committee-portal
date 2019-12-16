<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class ConnectorController extends Controller
{

    public function index()
    {
        return view('settings.connector.index');
    }

}
