<?php

namespace App\Modules\StrategicPlan\Http\Controllers;

use App\Modules\StrategicPlan\Entities\File;
use App\Modules\StrategicPlan\Entities\Note;
use App\Packages\FileUpload\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StrategicPlanController extends FileUploadController
{

    public function showUserPage() {
        return view('strategicplan::strategicplan');
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

    protected function fileModel(): string
    {
        return File::class;
    }

}