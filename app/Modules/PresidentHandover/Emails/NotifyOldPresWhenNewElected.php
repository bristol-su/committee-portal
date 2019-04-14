<?php

namespace App\Modules\PresidentHandover\Emails;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyOldPresWhenNewElected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $newPresident;

    public $group;

    public $committeeRole;

    public $oldPresident;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newPresident, $oldPresident, CommitteeRole $committeeRole, Group $group)
    {
        $this->newPresident = $newPresident;
        $this->oldPresident = $oldPresident;
        $this->committeeRole = $committeeRole;
        $this->group = $group;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Handover successful!')
            ->markdown('presidenthandover::emails.old_pres');
    }
}
