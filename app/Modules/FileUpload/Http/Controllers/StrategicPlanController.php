<?php

namespace App\Modules\FileUpload\Http\Controllers;

use App\Modules\StrategicPlan\Entities\File;
use App\Modules\StrategicPlan\Entities\Note;
use App\Modules\StrategicPlan\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;

class StrategicPlanController extends FileUploadController
{

    public function showUserPage() {
        return view('fileupload::strategicplan');
    }

    public function showAdminPage()
    {
        return view('fileupload::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('fileupload::note_template');
    }

    protected function templateModel(): string
    {
        return NoteTemplate::class;
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

    protected function fileModel(): string
    {
        return File::class;
    }

    protected function getModuleName() : string
    {
        return 'strategicplan';
    }
}