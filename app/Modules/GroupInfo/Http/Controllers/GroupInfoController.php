<?php

namespace App\Modules\GroupInfo\Http\Controllers;

use App\Modules\GroupInfo\Questions\QuestionService;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Question\Question;

class GroupInfoController extends Controller
{
    public function showPage()
    {

        $this->authorize('groupinfo.view');

        return view('groupinfo::groupinfo');
    }

    public function showAdminPage()
    {
        $this->authorize('groupinfo.view-admin');

        return view('groupinfo::admin');

    }

    public function changeInformation(Request $request)
    {
        $this->authorize('groupinfo.submit');

        return $request->all();
    }




    protected function getQuestions(QuestionService $questionService, Group $group)
    {
        $this->authorize('groupinfo.view');

        // TODO Reject if not allowed to access this group

        return [
            'questions' => $questionService->toArray()
        ];

    }

}
