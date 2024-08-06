<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@phosphor-icons/web" async></script>
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ loading: true }" x-init="window.onload = () => loading = false">
    <div x-show="loading" class="loader z-[999]" x-transition:enter="transition-opacity ease-out duration-500"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="backdrop-blur-md fixed inset-0 flex items-center justify-center h-screen z-[999] w-full">
            <div class="flex gap-2">
                <div class='flex space-x-2 justify-center items-center bg-transparent dark:invert z-[999]'>
                    <span class='sr-only'>Loading...</span>
                    <div class='h-8 w-8 bg-sky-500 rounded-full animate-bounce [animation-delay:-0.3s] z-[999]'></div>
                    <div class='h-8 w-8 bg-sky-500 rounded-full animate-bounce [animation-delay:-0.15s] z-[999]'></div>
                    <div class='h-8 w-8 bg-sky-500 rounded-full animate-bounce z-[999]'></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <livewire:header />
        <div class="w-full py-12 dark:bg-neutral-800 bg-slate-100">
            <div class="p-6 space-y-4 lg:pl-32 sm:space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>
