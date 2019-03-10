<?php

namespace App\Modules\Presentation\Http\Controllers;

use App\Modules\Presentation\Entities\File;
use App\Modules\Presentation\Entities\Note;
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


    protected function fileModel(): string
    {
        return File::class;
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

}
