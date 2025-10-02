<?php

namespace QuickPanel\Platform\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build(): self
    {
        return $this
            ->subject(trans('platform::common.email_subject_password_changed'))
            ->markdown('platform::emails.password-changed');
    }
}
