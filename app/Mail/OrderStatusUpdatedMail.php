<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $statut;

    public function __construct(Order $order, $statut)
    {
        $this->order = $order;
        $this->statut = $statut;
    }

    public function build()
    {
        return $this->subject('Mise à jour du statut de votre commande #'.$this->order->id)
                    ->markdown('emails.orders.status')
                    ->with([
                        'order' => $this->order,
                        'statut' => $this->statut
                    ]);
    }
}
