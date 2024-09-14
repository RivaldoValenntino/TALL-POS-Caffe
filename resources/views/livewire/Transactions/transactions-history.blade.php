<div>
    <div x-data="{ isOpen: false, startDate: @entangle('startDate'), endDate: @entangle('endDate') }" class="relative">

        {{-- Modal Transaction report --}}
        <div x-cloak x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[999] flex items-center justify-center overflow-y-auto bg-[rgba(0,0,0,0.75)] backdrop-blur-sm">
            <div
                class="flex flex-col flex-wrap p-5 mx-auto bg-white rounded-lg shadow-lg lg:max-w-2xl backdrop-blur-sm">
                <div class="flex justify-between">
                    <h1 class="py-2 font-bold">Report Transactions </h1>
                    <button @click="isOpen = false"><i class="ph ph-x"></i></button>
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <p class="py-2">Please select date first</p>
                <div class="flex justify-between mt-4">
                    <div class="flex items-center gap-4">
                        <input id="date-picker" wire:model="startDate" autocomplete="off"
                            class="rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200  disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder="Select Start Date" />
                        <span class="text-gray-500">To</span>
                        <input id="date-picker" wire:model="endDate" autocomplete="off"
                            class="rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200  disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder="Select End Date" />
                    </div>
                    <div class="flex gap-4 ml-4">
                        <button wire:click="export"
                            class="px-3 py-2 mr-4 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 {{ $startDate && $endDate ? 'cursor-pointer' : 'cursor-not-allowed' }}"><i
                                class="mr-2 ph ph-download"></i> Download</button>

                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}
        <!-- Table Section -->
        <div class="grid max-w-[85rem] px-8 gap-6 mx-auto lg:grid-cols-4 md:grid-cols-2 lg:mb-4 mb-24">
            <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                    <i class="text-3xl text-green-700 ph ph-cash-register"></i>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <span class="text-xl font-bold">{{ $totalTransactionsToday }}</span>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Transaction Today</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                    <i class="text-3xl text-green-700 ph ph-cash-register"></i>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <span class="text-xl font-bold">{{ $totalTransactionThisMonth }}</span>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Transaction This Month</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                    <i class="text-3xl text-green-700 ph ph-money"></i>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <span class="text-xl font-bold">@currency($totalRevenueToday)</span>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Revenue Today</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                    <i class="text-3xl text-green-700 ph ph-money"></i>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <span class="text-xl font-bold">@currency($totalRevenueThisMonth)</span>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Revenue this month</span>
                    </div>
                </div>
            </div>
        </div>
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
                                                            <circle cx="11" cy="11" r=" 8">
                                                            </circle>
                                                            <path d="m21 21-4.3-4.3"></path>
                                                        </svg>
                                                    </div>
                                                    <input class="search-btn" type="text"
                                                        wire:model.live.debounce.500ms="search" placeholder="Search...">
                                                </div>
                                            </div>
                                            <!-- End SearchBox -->
                                        </div>


                                        <div class="relative">
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                                                    <i
                                                        class="text-gray-400 ph ph-calendar shrink-0 size-4 dark:text-white/60"></i>
                                                </div>
                                                <input class="search-btn" type="text" wire:model.live='filterDate'
                                                    id="date-picker" placeholder="Filter by date">
                                            </div>
                                        </div>
                                        <button @click = "isOpen = !isOpen"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg gap-x-2 hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <i class="text-xl ph ph-file-xls"></i>
                                            <span>Export Transactions</span>
                                        </button>
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
                                                Cashier Name
                                            </span>
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Status
                                            </span>
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3 text-start whitespace-nowrap">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                Transaction Date
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
                                            {{-- <td class="px-6 py-3 whitespace-nowrap">
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
                                            </td> --}}

                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <span
                                                    class="text-sm text-gray-800 dark:text-white">{{ $transaction->user->name }}</span>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <span
                                                    class="text-sm text-gray-800 dark:text-white">{{ $transaction->created_at->format('d M Y') }}</span>
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
    @push('scripts')
        <script>
            const datepicker = flatpickr("#date-picker", {});

            const calendarContainer = datepicker.calendarContainer;
            const calendarMonthNav = datepicker.monthNav;
            const calendarNextMonthNav = datepicker.nextMonthNav;
            const calendarPrevMonthNav = datepicker.prevMonthNav;
            const calendarDaysContainer = datepicker.daysContainer;

            calendarContainer.className =
                `${calendarContainer.className} bg-white p-4 border border-blue-gray-50 rounded-lg shadow-lg shadow-blue-gray-500/10 font-sans text-sm font-normal text-blue-gray-500 focus:outline-none break-words whitespace-normal`;

            calendarMonthNav.className =
                `${calendarMonthNav.className} flex items-center justify-between mb-4 [&>div.flatpickr-month]:-translate-y-3`;

            calendarNextMonthNav.className =
                `${calendarNextMonthNav.className} absolute !top-2.5 !right-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarPrevMonthNav.className =
                `${calendarPrevMonthNav.className} absolute !top-2.5 !left-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarDaysContainer.className =
                `${calendarDaysContainer.className} [&_span.flatpickr-day]:!rounded-md [&_span.flatpickr-day.selected]:!bg-gray-900 [&_span.flatpickr-day.selected]:!border-gray-900`;
        </script>
    @endpush
</div>
