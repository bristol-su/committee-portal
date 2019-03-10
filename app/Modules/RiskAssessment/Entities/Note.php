<?php

namespace App\Modules\RiskAssessment\Entities;

use App\Packages\FileUpload\NoteModel;

class Note extends NoteModel
{
    public function getModuleName(): string
    {
        return 'riskassessment';
    }
}
