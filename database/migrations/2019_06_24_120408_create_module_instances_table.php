<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_instances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias');
            $table->unsignedInteger('activity_id');
            $table->string('slug');
            $table->unsignedInteger('module_instance_settings_id');
            $table->unsignedInteger('module_instance_permissions_id');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('active');
            $table->unsignedInteger('visible');
            $table->unsignedInteger('mandatory')->nullable();
            $table->string('complete')->nullable();
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
        Schema::dropIfExists('module_instances');
    }
}
