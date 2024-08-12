<div>
    <div class="container">
        <div class="px-8 mx-auto">
            <div class="grid grid-cols-12 gap-4">
                <div class="bg-white rounded-md shadow-md h-[650px] overflow-auto lg:col-span-8 md:col-span-2">
                    <div class="px-4 mt-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none  ps-3.5">
                                <i class="text-gray-400 ph ph-magnifying-glass"></i>
                            </div>
                            <input class="search-btn" type="text" placeholder="Find a menu.."
                                wire:model.live.debounce.300ms="searchMenu">
                        </div>
                        <div class="grid grid-cols-2 gap-4 px-4 py-2 sm:grid-cols-3 md:grid-cols-4">
                            @forelse ($menus as $categoryName => $menuItems)
                                <div class="col-span-full">
                                    <h1 class="text-xl font-bold">{{ $categoryName }}</h1>
                                </div>
                                @forelse ($menuItems as $menu)
                                    <div wire:click="addItem({{ $menu->id }})"
                                        class="col-span-1 px-2 py-1 transition-all duration-300 ease-in-out rounded-md cursor-pointer hover:scale-90">
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                            class="rounded-md aspect-[1/1]">
                                        <div class="mt-2">
                                            <h1 class="text-sm font-bold">{{ $menu->name }}</h1>
                                            <p class="text-sm font-semibold">@currency($menu->price)</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex items-center justify-center col-span-full">
                                        <h1>No Menu Found</h1>
                                    </div>
                                @endforelse
                            @empty
                                <div class="flex items-center justify-center mt-12 col-span-full">
                                    <h1 class="text-xl font-bold">No Menu Found</h1>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md shadow-md 1 lg:col-span-4 h-[650px] overflow-auto">
                    <div class="flex items-center justify-between p-4" x-cloak>
                        <h1 class="text-xl font-bold">Transaction</h1>
                        @livewire('customer.customer-actions')
                    </div>
                    <hr class="mb-4">
                    <div class="px-2">
                        <div class="p-1.5 min-w-full">
                            <div class="inline-flex w-full gap-x-2" x-cloak x-data="{
                                isHide: $wire.entangle('loading'),
                                search: @entangle('search'),
                                selectedCustomerId: @entangle('selectedCustomerId')
                            }">
                                <div class="w-full">
                                    <!-- SearchBox -->
                                    <div class="relative">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3.5">
                                                <i class="text-gray-400 ph ph-magnifying-glass"></i>
                                            </div>
                                            <input class="search-btn" type="text" placeholder="Choose a customer...."
                                                x-model="search" @click="search === '' ? $wire.resetCustomer() : ''"
                                                :class="{
                                                    'bg-neutral-200 text-neutral-500': selectedCustomerId !==
                                                        null &&
                                                        search !== ''
                                                }"
                                                wire:model.live.debounce.300ms="search">
                                        </div>
                                        @if (!empty($customers))
                                            <div class="absolute w-full p-2 bg-white rounded-md shadow-md top-12">
                                                <ul>
                                                    @forelse($customers as $customer)
                                                        <li class="px-4 py-2 rounded-md cursor-pointer hover:bg-neutral-200"
                                                            wire:click="selectCustomer({{ $customer->id }})">
                                                            {{ $customer->name }}
                                                        </li>
                                                    @empty
                                                        <li>No customers found</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End SearchBox -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div
                                        class="overflow-hidden border rounded-lg shadow dark:border-neutral-700 dark:shadow-gray-900">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-400">
                                                        Name</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-400">
                                                        Qty</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-400">
                                                        Price</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-400">
                                                        Amount</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-neutral-400">
                                                        Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                @foreach ($items as $key => $item)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                            {{ $key }}</td>
                                                        <td
                                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                            {{ $item['qty'] }}</td>
                                                        <td
                                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                            @currency($item['price'])</td>
                                                        <td
                                                            class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                            @currency($item['amount'])</td>
                                                        <td>
                                                            <div class="flex gap-4">
                                                                <button
                                                                    class="w-8 h-8 bg-gray-200 rounded-full hover:scale-90"
                                                                    wire:click="incrementQty('{{ $key }}')"><i
                                                                        class="font-bold ph ph-plus"></i></button>
                                                                <button
                                                                    class="w-8 h-8 bg-gray-200 rounded-full hover:scale-90"
                                                                    wire:click="removeItem('{{ $key }}')"><i
                                                                        class="ph ph-minus"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="py-4">
                                        <hr class="mt-2">
                                        <div class="inline-flex gap-4 rounded-md shadow-sm" role="group">
                                            <button x-on:click="$wire.setPaymentMethod('cash')"
                                                :class="{ 'bg-sky-500 text-white': $wire.payment_method === 'cash' }"
                                                type="button" class="mt-8 toggle-btn">
                                                <i class='mr-2 ph ph-money'></i>
                                                Cash
                                            </button>
                                            <button x-on:click="$wire.setPaymentMethod('qris')"
                                                :class="{ 'bg-sky-500 text-white': $wire.payment_method === 'qris' }"
                                                type="button" class="mt-8 toggle-btn">
                                                <i class="mr-2 ph ph-barcode"></i>
                                                Qris
                                            </button>
                                        </div>
                                        <img src="{{ asset('image/qr-contoh.png') }}" alt="" class="mt-4"
                                            x-show="$wire.payment_method === 'qris'" x-cloak width="200">
                                        <textarea name="description" wire:model.defer="description"
                                            class="w-full px-4 py-3 mt-4 border-2 border-gray-200 rounded-lg" cols="10" rows="5"
                                            placeholder="Notes"></textarea>
                                        <div class="inline-flex items-center justify-center w-full gap-2">
                                            <input type="text" wire:model="customers_pay"
                                                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                                                type-currency='IDR' id="rupiah" placeholder="Customer's Pay"
                                                x-on:keydown.enter="$wire.updateChange()">
                                            <button x-on:click="$wire.updateChange()"
                                                class="px-4 py-2 m-1 text-white bg-blue-500 rounded-lg">Enter</button>
                                        </div>
                                    </div>

                                    <div class="flex w-full">
                                        <div class="px-3 py-2">
                                            <h1>Total Price</h1>
                                            <h1 class="font-bold">@currency($totalPrice)</h1>
                                        </div>
                                        <div class="px-3 py-2">
                                            <h1>Change</h1>
                                            @if ($change <= $totalPrice || $change === 0)
                                                <h1 class="font-bold text-red-500">@currency($change)</h1>
                                            @else
                                                <h1 class="font-bold">@currency($change)</h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a wire:click.prevent="store" target="_blank"
                                class="w-full px-3 py-2 text-center transition duration-300 ease-in-out rounded-lg"
                                :class="{
                                    'bg-blue-500 text-white hover:bg-blue-600 cursor-pointer': !$wire
                                        .isCheckoutDisabled,
                                    'bg-blue-300 text-gray-200 cursor-not-allowed': $wire.isCheckoutDisabled
                                }"
                                :disabled="$wire.isCheckoutDisabled">
                                <i class="text-lg ph ph-printer"></i>
                                <span>Checkout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
