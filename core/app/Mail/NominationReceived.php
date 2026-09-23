<?php

namespace App\Mail;

use App\Models\Nomination;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NominationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public Nomination $nomination;

    public function __construct(Nomination $nomination)
    {
        $this->nomination = $nomination;
    }

    public function build()
    {
        return $this->from(
                env('NO_REPLAY_EMAIL', config('mail.from.address')),
                config('app.name')
            )
            ->subject('Your ProBiz Awards 2026 nomination — ' . $this->nomination->reference_id)
            ->view('emails.nomination-received');
    }
}
