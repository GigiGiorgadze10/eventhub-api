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

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        $htmlContent = file_get_contents(resource_path('views/emails/mailtrap-template.html')); 
        return $this->subject('New Event Notification')->html($htmlContent);  
    }
}
