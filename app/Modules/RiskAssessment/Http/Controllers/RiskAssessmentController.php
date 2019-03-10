<?php

namespace App\Modules\RiskAssessment\Http\Controllers;

use App\Modules\RiskAssessment\Entities\File;
use App\Modules\RiskAssessment\Entities\Note;
use App\Packages\FileUpload\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class RiskAssessmentController extends FileUploadController
{

    public function showUserPage() {
        return view('riskassessment::riskassessment');
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