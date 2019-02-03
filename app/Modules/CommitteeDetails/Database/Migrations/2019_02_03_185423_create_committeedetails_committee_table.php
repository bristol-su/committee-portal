<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteedetailsCommitteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committeedetails_committee', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('control_id');
            $table->string('unioncloud_id');
            $table->unsignedInteger('position_control_id');
            $table->unsignedInteger('group_control_id');
            $table->year('year');
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
        Schema::dropIfExists('committeedetails_committee');
    }
}
