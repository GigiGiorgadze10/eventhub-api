<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    // Constructor to pass event data
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    // Build the email
    public function build()
    {
        $htmlContent = file_get_contents(resource_path('views/emails/mailtrap-template.html')); // Path to your Mailtrap template file
        return $this->subject('New Event Notification')->html($htmlContent);  // Using raw HTML for email
    }
}
