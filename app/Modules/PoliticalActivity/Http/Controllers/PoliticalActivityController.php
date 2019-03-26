<?php

namespace App\Modules\PoliticalActivity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PoliticalActivityController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('politicalactivity.view');

        return view('politicalactivity::politicalactivity');
    }


    public function showAdminPage()
    {
        $this->authorize('politicalactivity.view-admin');

        return view('politicalactivity::admin');

    }

    public function confirm()
    {
        $this->authorize('politicalactivity.submit');

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
