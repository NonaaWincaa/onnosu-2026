<?php

namespace App\Mail;

use App\Models\TiketOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ETicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(TiketOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('[ONNOSU 2026] E-Tiket Resmi Pemesanan Tiket')
                    ->view('emails.eticket');
    }
}