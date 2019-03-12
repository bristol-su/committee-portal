<?php

namespace App\Modules\WABStrategicPlan\Entities;

use App\Packages\FileUpload\NoteTemplateModel;

class NoteTemplate extends NoteTemplateModel
{
    public function getModuleName(): string
    {
        return 'wabstrategicplan';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
