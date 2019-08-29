<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Support\Filters\FilterInstance;
use App\Support\Logic\Contracts\LogicRepository;
use App\Support\Logic\Logic;
use Illuminate\Http\Request;

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

    public function store(Request $request, LogicRepository $repository)
    {
        /** @var Logic $logic */
        $logic = $repository->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'for' => $request->input('for')
        ]);

        // TODO Refactor below

        foreach ($request->input('all_true', []) as $filterId) {
            $filter = FilterInstance::findOrFail($filterId);
            $filter->logic_type = 'all_true';
            $filter->logic_id = $logic->id;
            $filter->save();
        }

        foreach ($request->input('all_false', []) as $filterId) {
            $filter = FilterInstance::findOrFail($filterId);
            $filter->logic_type = 'all_false';
            $filter->logic_id = $logic->id;
            $filter->save();
        }

        foreach ($request->input('any_true', []) as $filterId) {
            $filter = FilterInstance::findOrFail($filterId);
            $filter->logic_type = 'any_true';
            $filter->logic_id = $logic->id;
            $filter->save();
        }

        foreach ($request->input('any_false', []) as $filterId) {
            $filter = FilterInstance::findOrFail($filterId);
            $filter->logic_type = 'any_false';
            $filter->logic_id = $logic->id;
            $filter->save();
        }

        return $logic;
    }

}
