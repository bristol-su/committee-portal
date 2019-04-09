<?php

namespace App\Modules\GDPR\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GDPRController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('gdpr.view');

        return view('gdpr::gdpr');
    }

    public function showAdminPage()
    {
        $this->authorize('gdpr.view-admin');

        return view('gdpr::admin');
    }
}
