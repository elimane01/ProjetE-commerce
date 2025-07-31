<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $oldStatus;
    public $newStatus;

    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre commande #' . $this->order->id)
            ->greeting('Bonjour ' . ($this->order->user ? $this->order->user->name : ''))
            ->line('Le statut de votre commande a été mis à jour.')
            ->line('Numéro de commande : #' . $this->order->id)
            ->line('Ancien statut : ' . ucfirst($this->oldStatus))
            ->line('Nouveau statut : ' . ucfirst($this->newStatus))
            ->action('Voir ma commande', url('/'))
            ->line('Merci pour votre confiance !');
    }
}
