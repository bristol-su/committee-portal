<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTierSelectionSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tierselection_submissions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('tier_id');
            $table->year('year');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tierselection_submissions', function(Blueprint $table) {
            $table->foreign('tier_id')->references('id')->on('tierselection_tiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tierselection_submissions');
    }
}
