<?php

namespace App\Modules\CommitteeDetails\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CommitteeDetailsController extends Controller
{

    public function showUserForm()
    {
        return view('committeedetails::details_submission');
    }

    public function addCommittee()
    {
        dd(request());
    }

}
