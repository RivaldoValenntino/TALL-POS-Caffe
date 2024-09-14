<div>
    <div class="container">

        <section class="flex flex-col max-w-2xl p-5 mx-auto mt-4 bg-white rounded-lg shadow-lg">
            <h1 class="py-2 font-bold">Report Revenue</h1>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <p class="py-2">Report revenue</p>
            <div class="flex justify-between mt-4">
                <div class="flex items-center gap-4">
                    <input id="date-picker" wire:model="startDateRevenue"
                        class="rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200  disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder="Select Start Date" />
                    <span class="text-gray-500">To</span>
                    <input id="date-picker" wire:model="endDateRevenue"
                        class="rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200  disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder="Select End Date" />
                </div>
                <div class="flex gap-4">
                    <button wire:click="exportRevenue"
                        class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"><i
                            class="mr-2 ph ph-download"></i> Download</button>
                </div>
            </div>
        </section>
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
</div>
