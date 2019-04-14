<?php

namespace App\Modules\PresidentHandover\Emails;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyNewPresWhenElected extends Mailable
{
    use Queueable, SerializesModels;

    public $newPresident;

    public $committeeRole;

    public $group;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newPresident, CommitteeRole $committeeRole, Group $group)
    {
        $this->newPresident = $newPresident;
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
            ->subject('Congratulations on your new position!')
            ->markdown('presidenthandover::emails.new_pres');
    }
}
