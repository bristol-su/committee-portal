<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Completion\Contracts\CompletionConditionInstanceRepository;
use Illuminate\Http\Request;

class CompletionConditionInstanceController extends Controller
{

    public function store(Request $request, CompletionConditionInstanceRepository $conditionInstanceRepository)
    {
        return $conditionInstanceRepository->create([
            'name' => $request->input('name', ''),
            'description' => $request->input('description', ''),
            'alias' => $request->input('alias'),
            'settings' => $request->input('settings')
        ]);
    }

}
