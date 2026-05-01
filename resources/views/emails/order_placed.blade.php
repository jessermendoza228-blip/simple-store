<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial; background: #f4f4f4; padding: 20px;">

    <div style="background: white; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto;">

        <h2>Order Confirmed 🎉</h2>

        <p>Hi {{ $order->name ?? 'Customer' }},</p>

        <p>Thank you for your order.</p>

        <hr>

        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Total:</strong> ₱{{ $order->total }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>

    </div>

</body>
</html>