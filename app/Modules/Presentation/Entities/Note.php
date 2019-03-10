<?php

namespace App\Modules\Presentation\Entities;

use App\Packages\FileUpload\NoteModel;
use Illuminate\Database\Eloquent\Model;

class Note extends NoteModel
{
    protected function getModuleName(): string
    {
        return 'presentation';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
