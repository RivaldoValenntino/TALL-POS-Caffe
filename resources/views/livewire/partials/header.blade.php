<div>
    <div x-data="{ isHide: true }" class="print:hidden">
        <header class="fixed top-0 w-full header-cls">
            <nav class="flex items-center w-full px-2 basis-full" aria-label="Global">
                <div
                    class="flex items-center {{ Auth::user()->role === 'admin' ? 'justify-between' : 'justify-end' }} w-full sm:gap-x-3 sm:order-3">
                    @can('admin')
                        <div @click="isHide = !isHide"
                            class="flex justify-start px-4 py-2 rounded hover:cursor-pointer hover:bg-neutral-700 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300">
                            <button type="button" data-hs-overlay="#application-sidebar" aria-controls="application-sidebar"
                                aria-label="Sidebar">
                                <i class="text-2xl text-white" :class="{ 'ph ph-list': isHide, 'ph ph-x': !isHide }"></i>
                            </button>
                        </div>
                    @endcan
                    <div class="flex flex-row items-center gap-2">
                        <div class="hidden mr-2 lg:block">
                            <button type="button" id="btn-fullscreen"><i
                                    class="text-xl text-white ph ph-corners-out"></i></button>
                        </div>
                        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button id="hs-dropdown-with-header" type="button"
                                class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700">
                                <img class="inline-block size-[20px] rounded-full  dark:ring-neutral-800"
                                    src="{{ asset('image/Blank-profile.png') }}" alt="Image Description">
                            </button>
                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:bg-neutral-900 dark:border dark:border-neutral-700"
                                aria-labelledby="hs-dropdown-with-header">
                                <div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg dark:bg-neutral-800">
                                    <p class="text-sm text-gray-500 dark:text-neutral-400">Signed in as</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">
                                        {{ auth()->user()->name }}
                                    </p>
                                </div>
                                <div class="py-2 mt-2 first:pt-0 last:pb-0">
                                    <form class="link-dropdown" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <i class="text-xl ph ph-sign-out"></i>
                                        <button type="submit">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Breadcrumb -->
        <div
            class="sticky inset-x-0 top-0 z-20 px-4 bg-white border-y sm:px-6 md:px-8 lg:hidden dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex items-center justify-between py-2">
                <!-- Breadcrumb -->

                <!-- End Breadcrumb -->

                <!-- Sidebar -->
                <button type="button" class="burger-sidebar" data-hs-overlay="#application-sidebar"
                    aria-controls="application-sidebar" aria-label="Sidebar">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
                    </svg>
                    <span class="sr-only">Sidebar</span>
                </button>
                <!-- End Sidebar -->
            </div>
        </div>
        <!-- End Breadcrumb -->

        @can('admin')
            <div>
                <div x-cloak id="application-sidebar" class="sidebar-cls hs-overlay [--auto-close:lg]"
                    @mouseenter="isHide = false" @mouseleave="isHide = true" :class="{ 'w-[70px]': isHide }">
                    <aside class="flex flex-col flex-wrap w-full pt-16 hs-accordion-group" data-hs-accordion-always-open>
                        <ul class="space-y-1.5 text-center pl-2">
                            <div class="px-2">
                                <li><a class="link-cls" href="{{ route('dashboard.dashboard') }}">
                                        <i class="text-xl ph ph-house"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Dashboard</span>
                                    </a></li>
                            </div>
                            @can('kasir')
                                <div class="px-2">
                                    <li><a class="link-cls" href="/dashboard/orders">
                                            <i class="text-xl ph ph-shopping-cart"></i>
                                            <span class="text-sm" :class="{ 'hidden': isHide }">Orders</span>
                                        </a></li>
                                </div>
                            @endcan
                            <div class="px-2">
                                <li><a class="link-cls" href="{{ route('dashboard.menu') }}">
                                        <i class="text-xl ph ph-squares-four"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Menu</span>
                                    </a></li>
                            </div>
                            <div class="px-2">
                                <li><a class="link-cls" href="{{ route('dashboard.categories') }}">
                                        <i class="text-xl ph ph-stack"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Category</span>
                                    </a></li>
                            </div>
                            <div class="px-2">
                                <li><a class="link-cls" href="{{ route('dashboard.customers') }}">
                                        <i class="text-xl ph ph-users-three"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Customers</span>
                                    </a></li>
                            </div>
                            <div class="px-2">
                                <li><a class="link-cls whitespace-nowrap" href="{{ route('dashboard.orders.history') }}">
                                        <i class="text-xl ph ph-clock-counter-clockwise"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Orders History</span>
                                    </a></li>
                            </div>
                            <div class="px-2">
                                <li><a class="link-cls whitespace-nowrap" href="{{ route('dashboard.report') }}">
                                        <i class="text-xl ph ph-file-xls"></i>
                                        <span class="text-sm" :class="{ 'hidden': isHide }">Report</span>
                                    </a></li>
                            </div>
                        </ul>
                    </aside>
                </div>
            </div>
        @endcan
    </div>
</div>
