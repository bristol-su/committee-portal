<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Packages\FileUpload\FileUploadMigration;

class CreateExecutiveSummaryFileUploadTables extends FileUploadMigration
{
    public function getModuleName(): string
    {
        return 'executivesummary';
    }
}
