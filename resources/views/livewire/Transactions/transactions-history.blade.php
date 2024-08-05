<div>
    <div>
        <!-- Table Section -->
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto" x-data="{ load: $wire.entangle('loading') }">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                            <!-- Header -->
                            <div
                                class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        Transactions
                                    </h2>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2" x-cloak>
                                        <div class="max-w-sm">
                                            <!-- SearchBox -->
                                            <div class="relative">
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                                                        <svg class="text-gray-400 shrink-0 size-4 dark:text-white/60"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <path d="m21 21-4.3-4.3"></path>
                                                        </svg>
                                                    </div>
                                                    <input class="search-btn" type="text"
                                                        wire:model.live.debounce.500ms="search" placeholder="Search...">
                                                </div>
                                            </div>
                                            <!-- End SearchBox -->
                                        </div>

                                        @livewire('customer.customer-actions')
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                #
                                            </span>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Customer Name
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Total Price
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Payment Method
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Status
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Created At
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Action
                                            </span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <span class="text-sm">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="flex items-center gap-x-3">
                                                    <span
                                                        class="text-sm font-semibold text-gray-800 dark:text-white">{{ $transaction->customer->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="flex items-center gap-x-3">
                                                    <span
                                                        class="text-sm font-semibold text-gray-800 dark:text-white">@currency($transaction->total)</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="flex items-center gap-x-3">
                                                    <span
                                                        class="text-sm font-semibold text-gray-800 dark:text-white">{{ Str::ucfirst($transaction->payment_method) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="relative inline-flex hs-dropdown">
                                                    <button id="hs-dropdown-{{ $transaction->id }}" type="button"
                                                        class="hs-dropdown-toggle dropdown-button" aria-haspopup="menu"
                                                        aria-expanded="false" aria-label="Dropdown">
                                                        {{ Str::ucfirst($transaction->status) }}
                                                        <svg class="hs-dropdown-open:rotate-180 size-4"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" k
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="m6 9 6 6 6-6" />
                                                        </svg>
                                                    </button>

                                                    <div class="dropdown-btn hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100"
                                                        role="menu" aria-orientation="vertical"
                                                        aria-labelledby="hs-dropdown-{{ $transaction->id }}">
                                                        <a class="dropdown-link" href="#"
                                                            wire:click.prevent="updateStatus({{ $transaction->id }}, 'process')">
                                                            Process
                                                        </a>
                                                        <a class="dropdown-link" href="#"
                                                            wire:click.prevent="updateStatus({{ $transaction->id }}, 'done')">
                                                            Done
                                                        </a>
                                                        <a class="dropdown-link" href="#"
                                                            wire:click.prevent="updateStatus({{ $transaction->id }}, 'cancelled')">
                                                            Cancelled
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <span
                                                    class="text-sm text-gray-800 dark:text-white">{{ $transaction->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <button type="button" class="mr-2 text-sm font-semibold text-red-600"
                                                    wire:click="delete({{ $transaction->invoice_number }})">
                                                    <i class="ph ph-trash-simple"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <button type="button"
                                                    class="mr-2 text-sm font-semibold text-blue-500">
                                                    <a
                                                        href="{{ route('dashboard.orders.detail', $transaction->invoice_number) }}">
                                                        <i class="ph ph-eye"></i>
                                                        <span>Detail</span>
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-6 py-3 text-center whitespace-nowrap">
                                                <span class="text-sm">No Records Found!!</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->

                            <div class="p-3">
                                {{ $transactions->links() }}
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
    </div>

</div>
