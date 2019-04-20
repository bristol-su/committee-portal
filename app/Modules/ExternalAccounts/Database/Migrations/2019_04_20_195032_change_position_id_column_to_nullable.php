<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePositionIdColumnToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('externalaccounts_submissions', function(Blueprint $table) {
            $table->unsignedInteger('position_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('externalaccounts_submissions', function(Blueprint $table) {
            $table->unsignedInteger('position_id')->change();
        });
    }
}
