<?php

namespace App\Modules\ExecutiveSummary\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ExecutiveSummaryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionAndRoleSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}