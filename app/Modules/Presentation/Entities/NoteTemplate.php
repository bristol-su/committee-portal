<?php

namespace App\Modules\Presentation\Entities;

use App\Packages\FileUpload\NoteTemplateModel;

class NoteTemplate extends NoteTemplateModel
{
    public function getModuleName(): string
    {
        return 'presentation';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
