<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="invoice-container">
        <div class="invoice">
            <h1 class="invoice-title">{{ config('app.name') }}</h1>
            <hr class="invoice-divider">
            <div class="invoice-header">
                <div class="invoice-info">
                    <div>Date: {{ $order->created_at->format('d M, Y') }}</div>
                    <div>Invoice No: {{ $order->invoice_number }}</div>
                </div>
            </div>
            <div class="invoice-details">
                <h2 class="section-title">Bill To:</h2>
                <div class="customer-info">
                    <div>Name: {{ $order->customer->name }}</div>
                    <div>Payment Method: {{ $order->payment_method }}</div>
                </div>
            </div>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $items = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                    @endphp
                    @foreach ($items as $itemName => $item)
                        <tr>
                            <td>{{ $itemName }}</td>
                            <td>@currency($item['price'])</td>
                            <td>{{ $item['qty'] }}</td>
                            <td class="text-right">@currency($item['amount'])</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="total-label">Total</td>
                        <td class="total-amount">@currency($order->total)</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
