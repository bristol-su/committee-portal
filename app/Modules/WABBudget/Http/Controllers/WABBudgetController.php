<?php

namespace App\Modules\WABBudget\Http\Controllers;

use App\Modules\WABBudget\Entities\File;
use App\Modules\WABBudget\Entities\Note;
use App\Modules\WABBudget\Entities\NoteTemplate;
use App\Packages\FileUpload\FileUploadController;

class WABBudgetController extends FileUploadController
{
    public function showUserPage()
    {
        return view('wabbudget::wabbudget');
    }

    public function showAdminPage()
    {
        return view('wabbudget::admin');
    }

    public function showNoteTemplatePage()
    {
        return view('wabbudget::note_template');
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
        return 'wabbudget';
    }
}
