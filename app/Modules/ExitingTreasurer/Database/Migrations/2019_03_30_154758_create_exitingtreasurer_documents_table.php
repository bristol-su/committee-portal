<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitingtreasurerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exitingtreasurer_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year');
            $table->string('title');
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('path')->nullable();
            $table->integer('size')->nullable();
            $table->enum('type', [
                'income_expenditure',
                'transaction_list'
            ]);
            $table->boolean('uploaded')->default(false);
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('uploaded_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exitingtreasurer_documents');
    }
}
