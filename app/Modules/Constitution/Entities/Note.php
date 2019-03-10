<?php

namespace App\Modules\Constitution\Entities;

use App\Packages\FileUpload\NoteModel;

class Note extends NoteModel
{
    public function getModuleName(): string
    {
        return 'constitution';
    }
}
