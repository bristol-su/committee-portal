<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddGroupAndSubgroupToPermissionsTable extends Migration
{
    public function up()
    {
        Schema::table('permissions', function(Blueprint $table) {
            $table->string('group')->nullable()->after('name');
            $table->string('subgroup')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('permissions', function(Blueprint $table) {
            $table->dropColumn('group');
            $table->dropColumn('subgroup');
        });
    }
}
