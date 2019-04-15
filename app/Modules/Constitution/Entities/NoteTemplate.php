<?php

namespace App\Modules\Constitution\Entities;

use App\Packages\FileUpload\NoteTemplateModel;

class NoteTemplate extends NoteTemplateModel
{
    public function getModuleName(): string
    {
        return 'constitution';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
