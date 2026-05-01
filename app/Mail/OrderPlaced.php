<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        // 🔥 load relationships safely (prevents queue crash)
        $this->order = $order->loadMissing('orderItems.product');
    }

    public function build()
    {
        return $this->subject('Order Confirmed #' . $this->order->id)
            ->view('emails.order-placed');
    }
}