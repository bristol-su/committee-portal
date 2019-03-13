<?php

namespace App\Modules\Constitution\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ConstitutionDatabaseSeeder extends Seeder
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
