<?php

namespace App\Notifications;

use App\Models\denr\DTS_DocRecordModel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VoucherPaidNotification extends Notification
{
    use Queueable;

    public $record;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DTS_DocRecordModel $record)
    {
        //
        $this->record = $record;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Voucher Payment Notification')
            ->line('Dear '. $notifiable->fname)
            ->line('We are pleased to inform you that the voucher named '.$this->record->DOC_NO.' has been successfully paid.')
            ->line('Thank you for your cooperation.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
