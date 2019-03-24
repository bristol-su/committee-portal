<?php

namespace App\Modules\GroupInfo\Events;

use App\Packages\ControlDB\Models\Group;
use App\User;
use Illuminate\Queue\SerializesModels;

class GroupInformationUpdated
{
    use SerializesModels;

    /**
     * @var Group
     */
    public $group;

    /**
     * @var User
     */
    public $user;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

}
