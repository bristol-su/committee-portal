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

class BookExternalCoaches extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if($this->data['external_coaches'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'external_coaches_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'external_coaches_no');
        } elseif($this->data['external_coaches'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'external_coaches_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'external_coaches_yes');
        }
    }
}