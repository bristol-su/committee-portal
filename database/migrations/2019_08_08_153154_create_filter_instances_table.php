<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_instances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alias');
            $table->string('name');
            $table->json('settings');
            $table->unsignedInteger('logic_id')->nullable();
            $table->string('logic_type')->nullable();
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
        Schema::dropIfExists('filter_instances');
    }
}
