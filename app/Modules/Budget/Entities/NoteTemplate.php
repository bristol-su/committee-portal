<?php

namespace App\Modules\Budget\Entities;

use App\Packages\FileUpload\NoteTemplateModel;

class NoteTemplate extends NoteTemplateModel
{
    public function getModuleName(): string
    {
        return 'budget';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
