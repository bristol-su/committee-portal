<?php

namespace App\Modules\Constitution\Http\Controllers;

use App\Modules\Constitution\Entities\File;
use App\Modules\Constitution\Entities\Note;
use App\Packages\FileUpload\FileUploadController;

class ConstitutionController extends FileUploadController
{

    public function showUserForm()
    {
        return view('constitution::constitution');
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