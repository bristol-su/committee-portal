<?php

namespace App\Modules\ExitingTreasurer\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyExitingTreasurerWhenDocumentReadyForReview extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public $group;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $group)
    {
        $this->user = $user;
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
            ->subject('Document ready for sign-off')
            ->markdown('exitingtreasurer::emails.exiting_treasurer_when_document_uploaded_for_review');
    }
}
