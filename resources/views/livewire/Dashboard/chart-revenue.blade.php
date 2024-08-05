<div class="col-span-6">
    <!-- Chart Revenue -->
    <div class="p-4 bg-white rounded-lg shadow-lg">
        <h1 class="mb-2 text-xl font-bold">Total Revenue per Month</h1>
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var rawChartData = @json($revenueData);

            var labels = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            var data = rawChartData;

            var ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            var revenueChart = new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Revenue per Month',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        data: data,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</div>
