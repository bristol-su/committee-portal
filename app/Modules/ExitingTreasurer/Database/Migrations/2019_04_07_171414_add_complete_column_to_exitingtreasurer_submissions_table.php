<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompleteColumnToExitingtreasurerSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exitingtreasurer_submissions', function (Blueprint $table) {
            $table->boolean('complete')->default(false)->after('has_corrections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exitingtreasurer_submissions', function (Blueprint $table) {
            $table->dropColumn('complete');
        });
    }
}
