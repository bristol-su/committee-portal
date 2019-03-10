<?php

namespace App\Modules\Presentation\Entities;

use App\Packages\FileUpload\FileModel;
use Illuminate\Database\Eloquent\Model;

class File extends FileModel
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
