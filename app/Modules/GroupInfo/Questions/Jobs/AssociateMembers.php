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

class AssociateMembers extends BaseJob
{

    use CanTagGroups;

    public function handle()
    {
        if($this->data['associate_members'] === 'yes') {
            $this->addOrUpdateTag($this->group, 'group_information', 'associate_members_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_no_interested');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_no');
        } elseif($this->data['associate_members'] === 'no_interested') {
            $this->addOrUpdateTag($this->group, 'group_information', 'associate_members_no_interested');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_no');
        } elseif($this->data['associate_members'] === 'no') {
            $this->addOrUpdateTag($this->group, 'group_information', 'associate_members_no');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_yes');
            $this->removeTagIfOwned($this->group, 'group_information', 'associate_members_no_interested');
        }
    }

}