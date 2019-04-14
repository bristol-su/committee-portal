<?php

namespace App\Modules\ExitingTreasurer\Emails;

use App\Packages\ControlDB\Models\Group;
use App\Traits\FindsUnionCloudUserByRoleName;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyExitingTreasurerWhenIncomingTreasurerTrained extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, FindsUnionCloudUserByRoleName;

    public $group;

    public $user;

    public $incomingTreasurer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Group $group, $user)
    {
        $this->group = $group;
        $this->user = $user;
        $this->incomingTreasurer = $this->newTreasurer($group);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Account Sign Off for '.$this->group->name)
            ->markdown('exitingtreasurer::emails.exiting_treasurer_when_incoming_treasurer_trained');
    }
}
