<?php

namespace App\Modules\StrategicPlan\Entities;

use App\Packages\FileUpload\NoteModel;

class Note extends NoteModel
{
    public function getModuleName(): string
    {
        return 'strategicplan';
    }
}
