<?php

namespace App\Modules\CommitteeDetails\Database\Seeders;

use Illuminate\Database\Seeder;
use Twigger\UnionCloud\API\UnionCloud;

class CommitteeDetailsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionAndRoleSeeder::class);


    }

}
