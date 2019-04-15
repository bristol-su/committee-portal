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

class IntramuralInterest extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if($this->data['intramural_interest'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_no');
        } elseif($this->data['intramural_interest'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_yes');
        }
    }

}