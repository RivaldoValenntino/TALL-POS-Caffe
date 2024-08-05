<div>
    <div class="max-w-md px-4 pt-4 mx-auto mt-8 invoice">
        <h1 class="my-4 text-2xl font-bold text-center text-blue-600">{{ config('app.name') }}</h1>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex justify-between mb-6">
            <div class="text-gray-700">
                <div>Date : {{ $transaction->created_at->format('d M, Y') }}</div>
                <div>Invoice No: {{ $transaction->invoice_number }}</div>
            </div>
        </div>
        <div class="mb-8">
            <h2 class="mb-4 text-lg font-bold">Bill To :</h2>
            <h2>Name :</h2>
            <div class="mb-2 text-gray-700">{{ $transaction->customer->name }}</div>
            <h2>Payment Method :</h2>
            <div class="mb-2 text-gray-700 capitalize">{{ $transaction->payment_method }}</div>
        </div>
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="font-bold text-left text-gray-700">Menu Name</th>
                    <th class="font-bold text-left text-gray-700">Price</th>
                    <th class="font-bold text-left text-gray-700">Qty</th>
                    <th class="font-bold text-right text-gray-700">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $items = is_string($transaction->items)
                        ? json_decode($transaction->items, true)
                        : $transaction->items;
                @endphp
                @foreach ($items as $itemName => $item)
                    <tr>
                        <td class="text-left text-gray-700">{{ $itemName }}</td>
                        <td class="text-left text-gray-700">@currency($item['price'])</td>
                        <td class="text-center text-gray-700">{{ $item['qty'] }}</td>
                        <td class="text-right text-gray-700">@currency($item['amount'])</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="font-bold text-left text-gray-700 " colspan="3">Total</td>
                    <td class="font-bold text-right text-gray-700">@currency($transaction->total)</td>
                </tr>
            </tfoot>
        </table>
        @push('scripts')
            <script>
                function printInvoice(url) {
                    const Invoice = window.open(url, '_blank', 'width=400,height=600')

                    Invoice.addEventListener('load', () => {
                        Invoice.print()
                        Invoice.addEventListener('afterprint', () => {

                        })
                    })
                }
                window.printInvoice = printInvoice
            </script>
        @endpush
    </div>
