<x-mail::message>
# Order Placed

Thank you for your order!

Order ID: #{{ $order->id }}

We will notify you when your order ships.

<x-mail::button :url="route('my-orders.show', $order)">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
