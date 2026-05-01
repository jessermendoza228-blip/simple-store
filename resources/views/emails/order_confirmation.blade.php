<!DOCTYPE html>
<html>
<body style="font-family: Arial;">
    <h2>Order Confirmed!</h2>

    <p>Hi {{ $order->name }},</p>

    <p>Your order #{{ $order->id }} has been placed successfully.</p>

    <p>Total: ₱{{ $order->total }}</p>

</body>
</html>