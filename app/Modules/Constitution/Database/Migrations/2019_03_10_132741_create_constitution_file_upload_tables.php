<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstitutionFileUploadTables extends \App\Packages\FileUpload\FileUploadMigration
{

    protected function getModuleName(): string
    {
        return 'constitution';
    }

}
