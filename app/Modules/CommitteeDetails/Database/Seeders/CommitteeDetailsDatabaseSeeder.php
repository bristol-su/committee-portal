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
        $this->generateCommittee(5);

        $this->generatePositionSetting();



    }

    protected function generateCommittee($count)
    {
        $unionCloud = resolve('Twigger\UnionCloud\API\UnionCloud');
        $uids = $this->getUids($unionCloud);
        $this->command->info('Generating committee members');
        for ($i=0;$i<$count;$i++) {
            if(count($uids) === 0) { $uids = $this->getUids($unionCloud); }
            factory(Committee::class)->create([
                'unioncloud_id' => array_shift($uids)
            ]);
        }
    }

    protected function generatePositionSetting() {

        $this->command->info('Generating position settings');

        $positionSettings = [
            [
                'tag_reference' => 'society',
                'allowed_positions' => [5,6,7,14],
                'required_positions' => [5,6,7],
                'position_only_has_single_committee_member' => [5,6,7],
                'committee_member_only_has_single_position' => [5,6]
            ],
            [
                'tag_reference' => 'sport',
                'allowed_positions' => [22,6,7,14],
                'required_positions' => [22,6,7],
                'position_only_has_single_committee_member' => [22,6,7],
                'committee_member_only_has_single_position' => [22,6]
            ],
            [
                'tag_reference' => 'volunteering',
                'allowed_positions' => [23,6,14],
                'required_positions' => [23],
                'position_only_has_single_committee_member' => [23,6],
                'committee_member_only_has_single_position' => [23,6]
            ]
        ];

        foreach($positionSettings as $positionSetting) {
            factory(PositionSetting::class)->create($positionSetting);
        }


    }

    private function getUids(UnionCloud $unionCloud, $timeout=5)
    {
        $letter = chr(rand(65,90));
        $uids = [];

        $i = 0;

        while(count($uids) === 0 || $i >= $timeout) {
            $this->command->info('Getting sample UIDs from UnionCloud');
            $uids = $unionCloud->users()->search(['forename' => $letter])->get()->pluck('uid'); //Search for something with a high number of results
            $i++;
        }
        return $uids;
    }
}
