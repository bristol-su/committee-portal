<?php

namespace App\Modules\Constitution\Http\Controllers;

use App\Modules\Constitution\Entities\File;
use App\Modules\Constitution\Entities\Note;
use App\Modules\Constitution\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;

class ConstitutionController extends FileUploadController
{

    public function showUserPage()
    {
        return view('constitution::constitution');
    }

    public function showAdminPage()
    {
        return view('constitution::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('constitution::note_template');
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
        return 'constitution';
    }

}