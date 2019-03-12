<?php

namespace App\Modules\WABStrategicPlan\Http\Controllers;

use App\Modules\WABStrategicPlan\Entities\File;
use App\Modules\WABStrategicPlan\Entities\Note;
use App\Modules\WABStrategicPlan\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WABStrategicPlanController extends FileUploadController
{
    public function showUserPage()
    {
        return view('wabstrategicplan::wabstrategicplan');
    }

    public function showAdminPage()
    {
        return view('wabstrategicplan::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('wabstrategicplan::note_template');
    }

    protected function templateModel(): string
    {
        return NoteTemplate::class;
    }

    protected function noteModel(): string
    {
        return Note::class;
    }

    protected function fileModel(): string
    {
        return File::class;
    }

    protected function getModuleName() : string
    {
        return 'wabstrategicplan';
    }
}
