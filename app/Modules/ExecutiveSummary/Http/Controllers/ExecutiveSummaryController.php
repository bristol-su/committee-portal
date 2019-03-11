<?php

namespace App\Modules\ExecutiveSummary\Http\Controllers;

use App\Modules\ExecutiveSummary\Entities\File;
use App\Modules\ExecutiveSummary\Entities\Note;
use App\Modules\ExecutiveSummary\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;

class ExecutiveSummaryController extends FileUploadController
{


    public function showUserPage()
    {
        return view('executivesummary::executive_summary');
    }

    public function showAdminPage()
    {
        return view('executivesummary::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('executivesummary::note_template');
    }

    protected function templateModel(): string
    {
        return NoteTemplate::class;
    }

    protected function fileModel(): string
    {
        return File::class;
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

    protected function getModuleName() : string
    {
        return 'executivesummary';
    }
}
