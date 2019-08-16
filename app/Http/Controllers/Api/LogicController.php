<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Logic\Logic;

class LogicController extends Controller
{

    public function show(Logic $logic)
    {
        return $logic;
    }

    public function index()
    {
        return Logic::all();
    }

}
