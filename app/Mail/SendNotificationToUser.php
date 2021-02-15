<?php

namespace App\Mail;

use App\Models\CustomerUser;
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
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CustomerUser $customer_user)
    {
        $this->customer_user = $customer_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendnotification');
    }
}
