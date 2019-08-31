<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('module_instance_id');
            $table->string('event');
            $table->json('keywords');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('role_id')->nullable();
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
        Schema::dropIfExists('event_stores');
    }
}
