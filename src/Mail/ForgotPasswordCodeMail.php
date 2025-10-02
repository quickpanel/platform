<?php

namespace QuickPanel\Platform\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public int $ttlMinutes;

    public function __construct(string $code, int $ttlMinutes)
    {
        $this->code = $code;
        $this->ttlMinutes = $ttlMinutes;
    }

    public function build(): self
    {
        return $this
            ->subject(trans('platform::common.email_subject_forgot_password'))
            ->markdown('platform::emails.forgot-password', [
                'code' => $this->code,
                'ttlMinutes' => $this->ttlMinutes,
            ]);
    }
}
