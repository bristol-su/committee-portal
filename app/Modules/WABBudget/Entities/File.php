<?php

namespace App\Modules\WABBudget\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'wabbudget';
    }

    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
