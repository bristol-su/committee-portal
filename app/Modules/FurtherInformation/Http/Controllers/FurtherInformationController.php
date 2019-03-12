<?php

namespace App\Modules\FurtherInformation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class FurtherInformationController extends Controller
{
    public function showFurtherInformation()
    {
        return view('furtherinformation::furtherinformation');
    }

}
