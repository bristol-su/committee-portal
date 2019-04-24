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

class Email extends BaseJob
{
    use CanTagGroups;

    public function handle()
    {
        $this->group->email = $this->data['email'];

        $this->group->save();
    }
}