<?php

namespace App\Modules\WABStrategicPlan\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
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
