<?php

namespace App\Modules\EquipmentList\Emails;

use App\Modules\EquipmentList\Entities\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubmitterOnEquipmentListSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     *
     * @param Submission $submission
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
            ->subject('Equipment List Submitted')
            ->markdown('equipmentlist::emails.equipment_list_submitted');
    }
}
