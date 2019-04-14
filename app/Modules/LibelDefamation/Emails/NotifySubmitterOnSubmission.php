<?php

namespace App\Modules\LibelDefamation\Emails;

use App\Modules\LibelDefamation\Entities\Submission;
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
            ->subject('Libel & Defamation Training Complete')
            ->markdown('libeldefamation::emails.submitted');
    }
}
