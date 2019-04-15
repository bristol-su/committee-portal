<?php

namespace App\Modules\TaskAllocation\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyResponsibleOnSubmission extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public $newPresident;

    public $tasks;

    public $group;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $group, $newPresident, $tasks)
    {
        $this->user = $user;
        $this->newPresident = $newPresident;
        $this->tasks = $tasks;
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
            ->subject('Responsibilities for '.$this->group->name)
            ->markdown('taskallocation::emails.responsible');
    }
}
