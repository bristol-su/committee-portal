<?php

namespace App\Modules\MainContacts\Emails;

use App\Packages\ControlDB\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyContactOnSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $group;

    public $newPresident;

    public $situations;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, Group $group, $newPresident, $situations)
    {
        $this->user = $user;
        $this->group = $group;
        $this->newPresident = $newPresident;
        $this->situations = $situations;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Contact for '.$this->group->name)
            ->markdown('maincontacts::emails.responsible');
    }
}
