<?php

namespace App\Modules\StrategicPlan\Entities;

use App\Packages\FileUpload\NoteTemplateModel;

class NoteTemplate extends NoteTemplateModel
{
    public function getModuleName(): string
    {
        return 'strategicplan';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
