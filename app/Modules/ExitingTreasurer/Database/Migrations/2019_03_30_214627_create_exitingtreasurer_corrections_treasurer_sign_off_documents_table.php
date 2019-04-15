<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitingtreasurerCorrectionsTreasurerSignOffDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exitingtreasurer_corrections_treasurer_sign_off_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('correction_id');
            $table->unsignedInteger('treasurer_sign_off_document_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exitingtreasurer_corrections_treasurer_sign_off_documents');
    }
}
