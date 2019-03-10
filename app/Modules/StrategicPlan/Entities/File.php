<?php

namespace App\Modules\StrategicPlan\Entities;

use App\Packages\FileUpload\FileModel;

class File extends FileModel
{
    public function getModuleName(): string
    {
        return 'strategicplan';
    }
}
