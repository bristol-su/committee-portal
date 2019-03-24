<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Jobs\Job;


use App\Modules\GroupInfo\Jobs\Job\Base\BaseJob;
use App\Traits\CanTagGroups;

class VolunteeringActivity extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if($this->data['volunteering_activity'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'volunteering_activity_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'volunteering_activity_no');
        } elseif($this->data['volunteering_activity'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'volunteering_activity_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'volunteering_activity_yes');
        }
    }
}