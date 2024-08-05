<div>
    <div class="container">
        {{-- <div class="absolute top-0 bottom-0 left-0 right-0 flex flex-row items-center justify-center gap-2 m-auto">
            <div class="w-10 h-10 ml-3 ease-linear border-t-2 border-b-2 border-blue-500 rounded-full animate-spin">
            </div>
        </div> --}}
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            @error('items')
                <div class="p-4 my-2 text-sm text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-lg dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500"
                    role="alert" tabindex="-1" aria-labelledby="hs-soft-color-warning-label">
                    <span id="hs-soft-color-warning-label" class="font-bold">Warning !!!</span> {{ $message }}
                </div>
            @enderror
            @error('customer_id')
                <div class="p-4 my-2 text-sm text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-lg dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500"
                    role="alert" tabindex="-1" aria-labelledby="hs-soft-color-warning-label">
                    <span id="hs-soft-color-warning-label" class="font-bold">Warning !!!</span> {{ $message }}
                </div>
            @enderror

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6 bg-white rounded-md shadow-md h-[720px] overflow-auto relative">
                    <div class="sticky px-4 mt-6 top-4">
                        <input type="text" placeholder="Find a menu..." wire:model.live.debounce.300ms="searchMenu"
                            class="w-full border-2 border-opacity-25 input-style z-[99]">
                    </div>
                    <div class="grid grid-cols-4 gap-4 px-4 py-2">
                        @forelse ($menus as $categoryName => $menuItems)
                            <div class="col-span-4">
                                <h1 class="text-xl font-bold">{{ $categoryName }}</h1>
                            </div>
                            @forelse ($menuItems as $menu)
                                <div wire:click="addItem({{ $menu->id }})"
                                    class="col-span-1 px-2 py-1 transition-all duration-300 ease-in-out rounded-md cursor-pointer bg-neutral-200 hover:scale-90">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="rounded-md aspect-square">
                                    <div class="mt-2">
                                        <h1 class="text-sm font-bold ">{{ $menu->name }}</h1>
                                        <p class="text-sm font-semibold">@currency($menu->price)</p>
                                    </div>
                                </div>
                            @empty
                                <div class="flex items-center justify-center">
                                    <h1>No Menu Found</h1>
                                </div>
                            @endforelse
                        @empty
                            <div class="flex items-center justify-center col-span-6 mt-12">
                                <h1 class="text-xl font-bold">No Menu Found</h1>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="relative col-span-6 bg-white rounded-md shadow-md">
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
                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
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
                                                :class="{ 'bg-gray-400 text-white': $wire.payment_method === 'cash' }"
                                                type="button" class="mt-8 toggle-btn">
                                                <i class='mr-2 ph ph-money'></i>
                                                Cash
                                            </button>
                                            <button x-on:click="$wire.setPaymentMethod('qris')"
                                                :class="{ 'bg-gray-400 text-white': $wire.payment_method === 'qris' }"
                                                type="button" class="mt-8 toggle-btn">
                                                <i class="mr-2 ph ph-barcode"></i>
                                                Qris
                                            </button>
                                        </div>
                                        <textarea name="description" wire:model.defer="description"
                                            class="w-full px-4 py-3 mt-4 border-2 border-gray-200 rounded-lg" cols="20" rows="5"
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

                                    <div class="flex justify-between w-full">
                                        <div class="px-3 py-2">
                                            <h1>Total Price</h1>
                                            <h1 class="font-bold">@currency($totalPrice)</h1>
                                        </div>
                                        <div class="px-3 py-2">
                                            <h1>Change</h1>
                                            <h1 class="font-bold">@currency($change)</h1>
                                        </div>
                                        <div class="px-3 py-2">
                                            <button wire:click="store"
                                                class="px-3 py-2 text-white bg-blue-500 rounded-lg">Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
