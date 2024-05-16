<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $str;
    public $userName; // Add a public property for the user's name
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($str, $userName, $email)
    {
        $this->str = $str;
        $this->userName = $userName; // Assign the user's name to the public property
        $this->email = $email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('otp')
            ->subject('رمز التحقق  - OTP Code')
            ->with([
                'token' => $this->str,
                'userName' => $this->userName, // Pass the user's name to the view
                'email' => $this->email,
            ]);
    }

//
//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'OTP Mail',
//        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'otp',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
