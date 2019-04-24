<?php

namespace App\Modules\MainContacts\Emails;

use App\Modules\MainContacts\Entities\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubmitterOnSubmission extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Notification Preferences Updated')
            ->markdown('maincontacts::emails.submitted');
    }
}
