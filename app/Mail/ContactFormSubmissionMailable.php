<?php

namespace App\Mail;

use App\Models\ContactFormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmissionMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The form submission.
     *
     * @var App\Models\ContactFormSubmission
     */
    public $submission;

    /**
     * Create a new message instance.
     *
     * @param App\Models\ContactFormSubmission $submission
     * @return void
     */
    public function __construct(ContactFormSubmission $submission)
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
        return $this->subject('New contact form submission')->view('emails.contact');
    }
}
