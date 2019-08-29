<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Support\Logic\Contracts\LogicRepository;
use App\Support\Logic\Logic;
use Illuminate\Http\Request;

class LogicController extends Controller
{
    public function index(LogicRepository $logicRepository)
    {
        return view('settings.logic.index')->with([
            'logics' => $logicRepository->all()
        ]);
    }

    public function create()
    {
        return view('settings.logic.create');
    }

    public function show(Logic $logic)
    {
        return view('settings.logic.show')->with(['logic' => $logic]);
    }

}
