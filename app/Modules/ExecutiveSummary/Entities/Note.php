<?php

namespace App\Modules\ExecutiveSummary\Entities;

use App\Packages\FileUpload\NoteModel;

class Note extends NoteModel
{
    public function getModuleName(): string
    {
        return 'executivesummary';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
