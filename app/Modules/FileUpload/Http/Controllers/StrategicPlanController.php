<?php

namespace App\Modules\FileUpload\Http\Controllers;

use App\Modules\StrategicPlan\Entities\File;
use App\Modules\StrategicPlan\Entities\Note;
use App\Modules\StrategicPlan\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;

class StrategicPlanController
{

    public function showUserPage() {
        return view('fileupload::strategicplan');
    }

    public function showAdminPage()
    {
        return view('fileupload::admin');
    }

}
