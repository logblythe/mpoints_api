<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $newPassword;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Password changed')
//            ->text('emails.auth.password_changed_plain')
            ->view('password_reset', [
                'user' => $this->user,
                'newPassword' => $this->newPassword
            ]);
    }
}
