<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnToTierselectionSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tierselection_submissions', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('tier_id')->nullable();
        });

        Schema::table('tierselection_submissions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tierselection_submissions', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
