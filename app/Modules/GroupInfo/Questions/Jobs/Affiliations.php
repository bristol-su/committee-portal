<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Jobs\Job;


use App\Modules\GroupInfo\Jobs\Job\Base\BaseJob;
use App\Packages\ControlDB\Models\GroupTag;
use App\Traits\CanTagGroups;

class Affiliations extends BaseJob
{

    use CanTagGroups;

    public function handle()
    {
        if($this->data['affiliations'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'affiliations_yes', [
                'affiliation_name' => $this->data['affiliations_yes_data']
            ]);
            $this->removeTagIfOwned($this->group, 'group_information', 'affiliations_no');
        } elseif($this->data['affiliations'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'affiliations_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'affiliations_yes');
        }
    }

}