<?php

namespace App\Modules\Budget\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'budget';
    }
}
