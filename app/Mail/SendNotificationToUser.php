<?php

namespace App\Mail;

use App\Models\CustomerUser;
use App\Models\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationToUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer user instance.
     *
     * @var CustomerUser
     */
    public $customer_user;

    /**
     * The notifications instance.
     *
     * @var Notifications
     */
    public $notifications;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CustomerUser $customer_user, string $batch_number)
    {
        $this->customer_user = $customer_user;

        $this->notifications = Notification::with('customer_user','vaccine_url')
                                           ->where(['batch_number' => $batch_number, 'customer_user_id' => $customer_user->id])
                                           ->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Vaccine Tracker Notification")->view('mail.sendnotification');
    }
}
