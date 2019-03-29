<?php

namespace App\Modules\Safeguarding\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SafeguardingController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('safeguarding.view');

        return view('safeguarding::safeguarding');
    }
}
