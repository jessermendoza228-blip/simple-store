@component('mail::message')
# Thank You for Your Order!

Hi **{{ $order->user->name }}**,

Your order has been placed successfully.

**Order #{{ $order->id }}**

@component('mail::table')
| Product | Qty | Price |
|:--------|:---:|------:|
@foreach($order->orderItems as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | ₱{{ number_format($item->price, 2) }} |
@endforeach
@endcomponent

**Total: ₱{{ number_format($order->total, 2) }}**

Thanks for shopping with us!

{{ config('app.name') }}
@endcomponent