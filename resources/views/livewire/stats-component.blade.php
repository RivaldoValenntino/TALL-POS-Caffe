<div>
    <!-- Component Start -->
    <div class="grid w-full gap-6 mx-auto lg:grid-cols-4 md:grid-cols-2">

        <!-- Tile for Total Revenue Today -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                <i class="text-3xl text-green-700 ph ph-coins"></i>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <span class="text-xl font-bold">@currency($totalRevenueToday)</span>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Revenue Today</span>
                </div>
            </div>
        </div>


        <!-- Tile for Total Revenue This Month -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-green-200 rounded-lg shadow-lg">
                <i class="text-3xl text-green-700 ph ph-money"></i>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <span class="text-xl font-bold">@currency($totalRevenueThisMonth)</span>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Revenue This Month</span>
                </div>
            </div>
        </div>

        <!-- Tile for Total Customers Today -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-blue-200 rounded-lg shadow-lg">
                <i class="text-3xl text-blue-700 ph ph-users"></i>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <span class="text-xl font-bold">{{ $totalCustomersToday }}</span>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Customers Today</span>
                </div>
            </div>
        </div>

        <!-- Tile for Total Transactions This Month -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-blue-200 rounded-lg shadow-lg">
                <i class="text-3xl text-blue-700 ph ph-cash-register"></i>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <span class="text-xl font-bold">{{ $totalTransactionThisMonth }}</span>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Transactions This Month</span>
                </div>
            </div>
        </div>

    </div>
    <!-- Component End  -->
</div>
