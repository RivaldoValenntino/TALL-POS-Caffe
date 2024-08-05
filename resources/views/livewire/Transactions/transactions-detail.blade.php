<div>
    {{-- @dd($transaction) --}}
    <!-- Invoice -->
    <div
        class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        <!-- Grid -->
        <div class="flex items-center justify-between pb-5 mb-5 border-b border-gray-200 dark:border-neutral-700">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Invoice</h2>
            </div>
            <!-- Col -->
            <div class="inline-flex gap-x-2">
                <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    onclick="return printInvoice('{{ route('dashboard.transactions.pdf', $transaction) }}')">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg>
                    Invoice PDF
                </a>
                <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    href="#">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect width="12" height="8" x="6" y="14" />
                    </svg>
                    Print
                </a>
            </div>
            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Grid -->
        <div class="grid gap-3 md:grid-cols-2">
            <div>
                <div class="grid space-y-3">
                    <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">Customer name:</dt>
                        <dd class="text-gray-800 dark:text-neutral-200">
                            <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 font-medium dark:text-blue-500"
                                href="javascript:void(0)">
                                {{ $transaction->customer->name }}
                            </a>
                        </dd>
                    </dl>

                    <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">Notes:</dt>
                        <dd class="font-medium text-gray-800 dark:text-neutral-200">
                            <p>{{ $transaction->description }}</p>
                        </dd>
                    </dl>

                    <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">Payment method:</dt>
                        <dd class="font-medium text-gray-800 dark:text-neutral-200">
                            <p class="block font-bold capitalize">{{ $transaction->payment_method }}</p>
                        </dd>
                    </dl>
                </div>
            </div>
            <!-- Col -->

            <div>
                <div class="grid space-y-3">
                    <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">Invoice number:</dt>
                        <dd class="font-medium text-gray-800 dark:text-neutral-200">{{ $transaction->invoice_number }}
                        </dd>
                    </dl>

                    <dl class="flex flex-col text-sm sm:flex-row gap-x-3">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">Order date:</dt>
                        <dd class="font-medium tracking-wider text-gray-800 dark:text-neutral-200">
                            {{ $transaction->created_at->format('d M,Y,g:i A') }}</dd>
                    </dl>


                </div>
            </div>
            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Table -->
        <div class="p-4 mt-6 space-y-4 border border-gray-200 rounded-lg dark:border-neutral-700">
            <div class="hidden sm:grid sm:grid-cols-5">
                <div class="text-xs font-medium text-gray-500 uppercase sm:col-span-2 dark:text-neutral-500">Item</div>
                <div class="text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">Qty</div>
                <div class="text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-500">Price</div>
                <div class="text-xs font-medium text-gray-500 uppercase text-end dark:text-neutral-500">Amount</div>
            </div>

            <div class="hidden border-b border-gray-200 sm:block dark:border-neutral-700"></div>
            @php
                $items = is_string($transaction->items) ? json_decode($transaction->items, true) : $transaction->items;
            @endphp
            @foreach ($items as $itemName => $item)
                <div class="grid grid-cols-3 gap-2 sm:grid-cols-5">
                    <div class="col-span-full sm:col-span-2">
                        <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">Item
                        </h5>
                        <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $itemName }}</p>
                    </div>
                    <div>
                        <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">Qty</h5>
                        <p class="text-gray-800 dark:text-neutral-200">{{ $item['qty'] }}</p>
                    </div>
                    <div>
                        <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">Rate
                        </h5>
                        <p class="text-gray-800 dark:text-neutral-200">@currency($item['price'])</p>
                    </div>
                    <div>
                        <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">Amount
                        </h5>
                        <p class="text-gray-800 sm:text-end dark:text-neutral-200">@currency($item['amount'])</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End Table -->

        <!-- Flex -->
        <div class="flex mt-8 sm:justify-end">
            <div class="w-full max-w-2xl space-y-2 sm:text-end">
                <!-- Grid -->
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-1 sm:gap-2">
                    <dl class="grid text-sm sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Total :</dt>
                        <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">@currency($transaction->total)</dd>
                    </dl>


                    <dl class="grid text-sm sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Amount paid :</dt>
                        <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                            @currency($transaction->customers_pay)
                        </dd>
                    </dl>

                    <dl class="grid text-sm sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Change :</dt>
                        <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">@currency($transaction->change)</dd>
                    </dl>
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Flex -->
    </div>
    @push('scripts')
        <script>
            function printInvoice(url) {
                const Invoice = window.open(url, '_blank', 'width=600,height=600')
                Invoice.addEventListener('load', () => {
                    Invoice.print()
                    Invoice.addEventListener('afterprint', () => {
                        Invoice.close()
                    })
                });
                return false;
            }
            window.printInvoice = printInvoice
        </script>
    @endpush
    <!-- End Invoice -->
</div>
