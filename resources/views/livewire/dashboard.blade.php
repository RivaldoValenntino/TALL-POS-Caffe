<div class="px-8 pl-24">
    @livewire('dashboard.stats-component')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-6">
            <div class="flex flex-col mt-4 space-y-4">
                @livewire('dashboard.chart-customer')
                @livewire('dashboard.chart-revenue')
            </div>
        </div>
        <div class="col-span-12 mt-4 md:col-span-6">
            @livewire('dashboard.chart-menu')
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-4">
    </div>
</div>
