<?php

namespace App\Modules\CommitteeDetails\Database\Seeders;

use App\Modules\CommitteeDetails\Entities\Committee;
use App\Modules\CommitteeDetails\Entities\PositionSetting;
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

        $this->generatePositionSetting();

    }

    protected function generatePositionSetting() {

        $this->command->info('Generating position settings');

        $positionSettings = [
            [
                'tag_reference' => 'society',
                'allowed_positions' => [5, 6, 7, 14],
                'required_positions' => [5, 6, 7],
                'position_only_has_single_committee_member' => [5, 6, 7],
                'committee_member_only_has_single_position' => [5, 6]
            ],
            [
                'tag_reference' => 'sport',
                'allowed_positions' => [22, 6, 7, 14],
                'required_positions' => [22, 6, 7],
                'position_only_has_single_committee_member' => [22, 6, 7],
                'committee_member_only_has_single_position' => [22, 6]
            ],
            [
                'tag_reference' => 'volunteering',
                'allowed_positions' => [23, 6, 14],
                'required_positions' => [23],
                'position_only_has_single_committee_member' => [23, 6],
                'committee_member_only_has_single_position' => [23, 6]
            ]
        ];

        foreach ($positionSettings as $positionSetting) {
            factory(PositionSetting::class)->create($positionSetting);
        }


    }
}
