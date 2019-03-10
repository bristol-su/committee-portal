<?php

namespace App\Modules\TierSelection\Database\Seeders;

use App\Modules\TierSelection\Entities\Tier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TierSelectionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tier::class, 3)->create();
    }
}
