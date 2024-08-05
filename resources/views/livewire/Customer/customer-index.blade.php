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
                                    Customers
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
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                            Name
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
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <span class="text-sm">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <div class="flex items-center gap-x-3">
                                                <span
                                                    class="text-sm font-semibold text-gray-800 dark:text-white">{{ $customer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <span
                                                class="text-sm text-gray-800 dark:text-white">{{ $customer->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <button type="button" class="mr-2 text-sm font-semibold text-red-600"
                                                wire:click="delete({{ $customer->id }})">
                                                <i class="ph ph-trash-simple"></i>
                                                <span>Delete</span>
                                            </button>
                                            <button type="button" class="text-sm font-semibold text-blue-500"
                                                wire:click="edit({{ $customer->id }})">
                                                <div class="animate-spin inline-block size-3 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"
                                                    role="status" aria-label="loading" x-show="load">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <i class="ph ph-pencil-simple-line" x-show="!load"></i>
                                                <span wire:loading.remove
                                                    wire:target="edit({{ $customer->id }})">Edit</span>
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
                            {{ $customers->links() }}
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
