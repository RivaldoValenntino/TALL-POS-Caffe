<!-- resources/views/livewire/dashboard/chart-customer.blade.php -->
<div>
    <!-- Chart Revenue -->
    <div class="p-4 bg-white rounded-lg shadow-lg">
        <h1 class="mb-2 text-xl font-bold">Customers Per Month</h1>
        <canvas id="customersChart" width="400" height="100"></canvas>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const customersData = @json($customersData);
            var labels = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            const ctx = document.getElementById('customersChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total customers per Month',
                        data: customersData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
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
