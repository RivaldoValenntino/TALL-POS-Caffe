<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Report</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Customers Pay</th>
                <th>Change</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->invoice_number }}</td>
                    <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                    <td>
                        @php
                            $items = is_string($transaction->items)
                                ? json_decode($transaction->items, true)
                                : $transaction->items;

                            $itemDetails = [];
                            foreach ($items as $itemName => $item) {
                                $itemDetails[] = "{$itemName} ({$item['qty']})";
                            }

                            $itemNames = implode(', ', $itemDetails);
                        @endphp
                        {{ $itemNames }}
                    </td>
                    <td>@currency($transaction->total) </td>
                    <td>@currency($transaction->customers_pay)</td>
                    <td>@currency($transaction->change ?? 0)</td>
                    <td>{{ $transaction->payment_method }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
