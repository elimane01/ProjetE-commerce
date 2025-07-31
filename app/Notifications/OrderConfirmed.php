<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre commande #' . $this->order->id)
            ->greeting('Bonjour ' . ($this->order->user ? $this->order->user->name : ''))
            ->line('Votre commande a bien été enregistrée !')
            ->line('Numéro de commande : #' . $this->order->id)
            ->line('Date : ' . $this->order->created_at->format('d/m/Y H:i'))
            ->line('Total : ' . number_format($this->order->calculated_total, 0, ',', ' ') . ' CFA')
            ->action('Voir ma commande', url('/'))
            ->line('Merci pour votre confiance !');
    }
}
