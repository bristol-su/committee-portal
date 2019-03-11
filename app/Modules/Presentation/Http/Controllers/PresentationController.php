<?php

namespace App\Modules\Presentation\Http\Controllers;

use App\Modules\Presentation\Entities\File;
use App\Modules\Presentation\Entities\Note;
use App\Modules\Presentation\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PresentationController extends FileUploadController
{

    public function showUserPage()
    {
        return view('presentation::presentation');
    }

    public function showAdminPage()
    {
        return view('presentation::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('presentation::note_template');
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
        return 'presentation';
    }

}
