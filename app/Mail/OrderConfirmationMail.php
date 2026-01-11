<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $sujet = 'Confirmation de votre commande #'.$this->order->id;
        if ($this->order->mode_paiement === 'en_ligne' && $this->order->statut === 'validee') {
            $sujet = 'Confirmation de paiement de votre commande #'.$this->order->id;
        }
        return $this->subject($sujet)
                    ->markdown('emails.orders.confirmation')
                    ->with(['order' => $this->order]);
    }
}
