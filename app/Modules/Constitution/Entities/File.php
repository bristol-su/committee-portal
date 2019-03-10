<?php

namespace App\Modules\Constitution\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'constitution';
    }
}
