<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 10/03/19
 * Time: 12:05
 */

namespace App\Packages\FileUpload;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

abstract class FileUploadMigration extends Migration
{

    /**
     * Return the name of the module
     *
     * @return string
     */
    abstract protected function getModuleName() : string;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getModuleName().'_files', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->year('year');
            $table->string('title');
            $table->string('filename');
            $table->string('mime');
            $table->string('path');
            $table->integer('size');
            $table->enum('status', [
                'awaiting approval',
                'approved',
                'rejected'
            ])->default('awaiting approval');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create($this->getModuleName().'_file_notes', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('file_id');
            $table->text('note');
            $table->timestamps();
        });

        Schema::create($this->getModuleName().'_file_note_templates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->text('template');
            $table->timestamps();
        });

        Schema::table($this->getModuleName().'_files', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table($this->getModuleName().'_file_notes', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('file_id')->references('id')->on($this->getModuleName().'_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getModuleName().'_files');
        Schema::dropIfExists($this->getModuleName().'_file_notes');

    }
}