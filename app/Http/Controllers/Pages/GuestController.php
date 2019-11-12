<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class GuestController extends Controller
{

    public function index()
    {
        return view('portal.welcome');
    }

}

