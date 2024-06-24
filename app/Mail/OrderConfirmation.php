<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderDetails;

    public function __construct()
    {
        
    }

    public function build()
    {
        return $this->subject('Đặt hàng thành công')
                    ->view('mailOrdersuccess');
    }
}
