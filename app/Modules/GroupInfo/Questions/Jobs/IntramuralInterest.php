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

class IntramuralInterest extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if($this->data['intramural_interest'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_unsure');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_what_is_it');
        } elseif($this->data['intramural_interest'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_unsure');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_what_is_it');
        } elseif($this->data['intramural_interest'] === 'unsure') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_unsure');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_what_is_it');
        } elseif($this->data['intramural_interest'] === 'what_is_it') {
            $this->addOrUpdateTag($this->group, 'group_information', 'intramural_interest_what_is_it');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'intramural_interest_unsure');
        }
    }

}