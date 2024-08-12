<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .invoice-container {
            width: 400px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0;
            padding: 0;
        }

        .header p {
            margin: 2px 0;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            padding: 4px;
            margin: 4px 0;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            white-space: nowrap;
            border-bottom: 2px dashed #aaa;
            padding: 5px;
            text-align: left;
        }

        .items-table th {
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }

        .items-table td {
            font-size: 12px;
        }

        .totals {
            text-align: right;
            margin-bottom: 20px;
        }

        .totals p {
            margin: 4px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p>Jl. Cempedak No. 10</p>
        </div>

        <div class="details">
            <p>Invoice No: {{ $transaction->invoice_number }}</p>
            @php
                use Carbon\Carbon;
            @endphp
            <p>Date: {{ Carbon::parse($transaction->created_at)->translatedFormat('l, d F Y H:i') }}</p>
            <p>Customer: {{ $transaction->customer->name }}</p>
        </div>
        <hr>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->items as $item => $details)
                    <tr>
                        <td>{{ $item }}</td>
                        <td>{{ $details['qty'] }}</td>
                        <td>@currency($details['price'])</td>
                        <td>@currency($details['amount'])</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($transaction->description)
            <p>Notes : {{ $transaction->description }}</p>
        @endif
        <div class="totals">
            <p><strong>Total:</strong> @currency($transaction->total)</p>
            <p><strong>Amount Paid:</strong> @currency($transaction->customers_pay)</p>
            <p><strong>Change:</strong> @currency($transaction->change)</p>
        </div>
        <hr>
        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>Visit us again!</p>
        </div>
    </div>
</body>

</html>
