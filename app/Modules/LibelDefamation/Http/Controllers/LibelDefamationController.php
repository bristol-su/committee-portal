<?php

namespace App\Modules\LibelDefamation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LibelDefamationController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('libeldefamation.view');

        return view('libeldefamation::libeldefamation');
    }


    public function showAdminPage()
    {
        $this->authorize('libeldefamation.view-admin');

        return view('libeldefamation::admin');

    }

    public function confirm()
    {
        $this->authorize('libeldefamation.submit');

        dd(request());
        // TODO Process submission
    }

    /**
     * Check if the user has confirmed this already
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function isComplete()
    {
        if(false) {
            return response('', 200);
        }
        return response('', 503);
    }
}
