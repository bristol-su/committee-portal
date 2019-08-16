<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Logic\Logic;
use Illuminate\Http\Request;

class LogicController extends Controller
{
    public function index()
    {
        return view('settings.logic.index')->with([
            'logics' => Logic::all()
        ]);
    }

    public function create()
    {
        return view('settings.logic.create');
    }

    public function store(Request $request)
    {
        return Logic::create($request->all());
    }

    public function show(Logic $logic)
    {
        return view('settings.logic.show')->with(['logic' => $logic]);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}
