<?php

namespace App\Modules\Budget\Http\Controllers;

use App\Modules\Budget\Entities\File;
use App\Modules\Budget\Entities\Note;
use App\Packages\FileUpload\FileUploadController;

class BudgetController extends FileUploadController
{

    public function showUserForm()
    {
        return view('budget::budget');
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
