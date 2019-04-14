<?php

namespace App\Packages\FileUpload;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentStatusChangedApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $file;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file, $subject)
    {
        $this->file = $file;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->subject.' Approved')
            ->markdown('emails.file_upload.file_status_updated_approved');
    }
}
