<?php

namespace App\Modules\RiskAssessment\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'riskassessment';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
