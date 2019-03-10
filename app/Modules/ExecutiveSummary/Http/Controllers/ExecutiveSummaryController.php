<?php

namespace App\Modules\ExecutiveSummary\Http\Controllers;

use App\Modules\ExecutiveSummary\Entities\File;
use App\Modules\ExecutiveSummary\Entities\Note;
use App\Packages\FileUpload\FileUploadController;

class ExecutiveSummaryController extends FileUploadController
{


    public function showUserPage()
    {
        return view('executivesummary::executive_summary');
    }


    protected function fileModel(): string
    {
        return File::class;
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

}
