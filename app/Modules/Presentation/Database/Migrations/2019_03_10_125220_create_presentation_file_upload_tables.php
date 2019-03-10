<?php

use App\Packages\FileUpload\FileUploadMigration;

class CreatePresentationFileUploadTables extends FileUploadMigration
{

    protected function getModuleName(): string
    {
        return 'presentation';
    }
}
