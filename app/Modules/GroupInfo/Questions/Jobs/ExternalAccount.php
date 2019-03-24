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

class ExternalAccount extends BaseJob
{

    use CanTagGroups;

    public function handle()
    {
        if($this->data['external_account'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'external_account_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'external_account_no');
        } elseif($this->data['external_account'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'external_account_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'external_account_yes');
        }
    }
}