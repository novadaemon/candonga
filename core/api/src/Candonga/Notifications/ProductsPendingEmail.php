<?php

namespace Candonga\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class ProductsPendingEmail extends Notification
{

    protected $products;

    protected $weeks;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct(Collection $products, int $weeks)
    {
        $this->products = $products;
        $this->weeks = $weeks;
    }


    /**
     * Get the notification's channels.
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Products pending')
            ->view('emails.products_pending',
                [
                    'products' => $this->products,
                    'weeks' => $this->weeks,
                ]
            );
    }


}
