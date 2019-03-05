<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committeedetails_position_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_reference');
            $table->text('allowed_positions');
            $table->text('required_positions');
            $table->text('position_only_has_single_committee_member');
            $table->text('committee_member_only_has_single_position');
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
        Schema::dropIfExists('committeedetails_position_settings');
    }
}
