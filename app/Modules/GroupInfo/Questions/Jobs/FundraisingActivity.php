<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Jobs;


use App\Modules\GroupInfo\Questions\Jobs\Base\BaseJob;
use App\Traits\CanTagGroups;

class FundraisingActivity extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if($this->data['fundraising_activity'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'fundraising_activity_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'fundraising_activity_no');
        } elseif($this->data['fundraising_activity'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'fundraising_activity_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'fundraising_activity_yes');
        }
    }
}