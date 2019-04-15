<?php

namespace App\Modules\NGB\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NGBController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('ngb.view');

        return view('ngb::ngb');
    }

    public function showAdminPage()
    {
        $this->authorize('ngb.view-admin');

        return view('ngb::admin');
    }

}
