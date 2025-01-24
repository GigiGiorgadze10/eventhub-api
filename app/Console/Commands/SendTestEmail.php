<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:test-email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to the specified address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Logic to send the email
        Mail::raw('This is a test email from EventHub API.', function ($message) use ($email) {
            $message->to($email)
                ->subject('Test Email');
        });

        $this->info("Test email sent to: {$email}");
    }
}
