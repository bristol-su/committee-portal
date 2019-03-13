<?php

namespace App\Modules\FurtherInformation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FurtherInformationController extends Controller
{
    public function showFurtherInformation()
    {
        $this->authorize('furtherinformation.view');

        return view('furtherinformation::furtherinformation');
    }

}
