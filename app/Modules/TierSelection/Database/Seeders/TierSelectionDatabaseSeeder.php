<?php

namespace App\Modules\TierSelection\Database\Seeders;

use App\Modules\TierSelection\Entities\Tier;
use Illuminate\Database\Seeder;

class TierSelectionDatabaseSeeder extends Seeder
{
    protected $tierData = [
        [
            'name' => 'Club Evolution',
            'filename' => 'images/seh-club-evolution.jpg',

        ],
        [
            'name' => 'Kickstart',
            'filename' => 'images/seh-kickstart.jpg',
        ],
        [
            'name' => 'Performance Sport',
            'filename' => 'images/seh-performance-sport.jpg',

        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tierData as $tierData) {
            if(Tier::where('name', $tierData['name'])->count() === 0 ) {
                $tier = new Tier($tierData);
                $tier->save();
            }
        }
    }
}
