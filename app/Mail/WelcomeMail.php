<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Inject the newly created user.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        
        /*$view = match ($this->user->role) {
            'admin'        => 'emails.welcome_admin',
            'owner'        => 'emails.welcome_owner',
            'veterinarian' => 'emails.welcome_veterinarian',
                default        => 'emails.welcome',
        };

         return $this->subject('Welcome to HansVet Booking')
                ->view($view);*/

        return $this
            ->subject('Welcome to HansVet Booking!')
            ->markdown('emails.welcome', [
                'user' => $this->user,
            ]);
    }
}