<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeViewAsStudentSportsToSportPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = \Spatie\Permission\Models\Permission::findByName('view-as-student-sports');

        $permission->name = 'view-as-student-sport';

        $permission->save();

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permission = \Spatie\Permission\Models\Permission::findByName('view-as-student-sport');

        $permission->name = 'view-as-student-sports';

        $permission->save();

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
