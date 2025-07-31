<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class PaymentStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $oldPaymentStatus;
    public $newPaymentStatus;

    public function __construct(Order $order, $oldPaymentStatus, $newPaymentStatus)
    {
        $this->order = $order;
        $this->oldPaymentStatus = $oldPaymentStatus;
        $this->newPaymentStatus = $newPaymentStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Mise à jour du paiement - Commande #' . $this->order->id)
            ->greeting('Bonjour ' . ($this->order->user ? $this->order->user->name : ''));

        if ($this->newPaymentStatus === 'payé') {
            $message->line('Votre paiement a été confirmé !')
                   ->line('Numéro de commande : #' . $this->order->id)
                   ->line('Montant payé : ' . number_format($this->order->calculated_total, 0, ',', ' ') . ' CFA')
                   ->line('Merci pour votre paiement !');
        } else {
            $message->line('Le statut de votre paiement a été mis à jour.')
                   ->line('Numéro de commande : #' . $this->order->id)
                   ->line('Nouveau statut : ' . ucfirst($this->newPaymentStatus));
        }

        return $message->action('Voir ma commande', url('/'))
                      ->line('Merci pour votre confiance !');
    }
} 