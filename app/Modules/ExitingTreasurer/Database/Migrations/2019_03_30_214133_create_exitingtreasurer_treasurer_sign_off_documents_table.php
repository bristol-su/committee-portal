<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitingtreasurerTreasurerSignOffDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exitingtreasurer_treasurer_sign_off_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('path')->nullable();
            $table->integer('size')->nullable();
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
        Schema::dropIfExists('exitingtreasurer_treasurer_sign_off_documents');
    }
}
