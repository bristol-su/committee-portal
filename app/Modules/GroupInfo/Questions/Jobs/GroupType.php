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

class GroupType extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        if ($this->data['group_type'] === 'society') {
            $this->addOrUpdateTag($this->group, 'group_information', 'group_type_society');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_volunteering');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_sport');
        } elseif ($this->data['group_type'] === 'sport') {
            $this->addOrUpdateTag($this->group, 'group_information', 'group_type_sport');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_society');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_volunteering');
        } elseif ($this->data['group_type'] === 'volunteering') {
            $this->addOrUpdateTag($this->group, 'group_information', 'group_type_volunteering');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_sport');
            $this->removeTagIfOwned($this->group, 'group_information', 'group_type_society');
        }
    }
}