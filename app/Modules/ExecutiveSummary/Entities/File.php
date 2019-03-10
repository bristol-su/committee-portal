<?php

namespace App\Modules\ExecutiveSummary\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'executivesummary';
    }

}
