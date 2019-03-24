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

class Email extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        $this->group->email = $this->data['email'];

        $this->group->save();
    }
}