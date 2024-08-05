<div>
    <div x-data="{ isHide: true }" class="print:hidden">
        <header class="fixed top-0 w-full header-cls">
            <nav class="flex items-center w-full px-2 basis-full" aria-label="Global">
                <div class="flex items-center justify-between w-full sm:gap-x-3 sm:order-3">
                    <div @click="isHide = !isHide"
                        class="flex justify-start px-4 py-2 rounded hover:cursor-pointer hover:bg-neutral-700 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300">
                        <button type="button">
                            <i class="text-2xl text-white" :class="{ 'ph ph-list': isHide, 'ph ph-x': !isHide }"></i>
                        </button>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <div class="mr-2">
                            <button type="button" id="btn-fullscreen"><i
                                    class="text-xl text-white ph ph-corners-out"></i></button>
                        </div>
                        {{-- <div class="mr-2">
                            <div class="hs-dropdown">
                                <button type="button"
                                    class="flex items-center font-medium text-white hs-dropdown-toggle hs-dark-mode group hover:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-500">
                                    <svg class="block hs-dark-mode-active:hidden size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                                    </svg>
                                    <svg class="hidden hs-dark-mode-active:block size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M12 2v2"></path>
                                        <path d="M12 20v2"></path>
                                        <path d="m4.93 4.93 1.41 1.41"></path>
                                        <path d="m17.66 17.66 1.41 1.41"></path>
                                        <path d="M2 12h2"></path>
                                        <path d="M20 12h2"></path>
                                        <path d="m6.34 17.66-1.41 1.41"></path>
                                        <path d="m19.07 4.93-1.41 1.41"></path>
                                    </svg>
                                </button>

                                <div id="selectThemeDropdown"
                                    class="hs-dropdown-menu hs-dropdown-open:opacity-100 mt-2 hidden z-10 transition-[margin,opacity] opacity-0 duration-300 mb-2 origin-bottom-left bg-white shadow-md rounded-lg p-2 space-y-1 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700">
                                    <button type="button"
                                        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                        data-hs-theme-click-value="default">
                                        Default (Light)
                                    </button>
                                    <button type="button"
                                        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                        data-hs-theme-click-value="dark">
                                        Dark
                                    </button>
                                    <button type="button"
                                        class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                        data-hs-theme-click-value="auto">
                                        Auto (System)
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button id="hs-dropdown-with-header" type="button"
                                class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700">
                                <img class="inline-block size-[38px] rounded-full ring-2 ring-white dark:ring-neutral-800"
                                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                    alt="Image Description">
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
                        <div class="px-2">
                            <li><a class="link-cls" href="{{ route('dashboard.orders') }}">
                                    <i class="text-xl ph ph-shopping-cart"></i>
                                    <span class="text-sm" :class="{ 'hidden': isHide }">Orders</span>
                                </a></li>
                        </div>
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
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</div>
