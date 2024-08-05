 <div class="col-span-6">
     <!-- Chart Menu -->
     <div class="p-4 bg-white rounded-lg shadow-lg">
         <h1 class="mb-2 text-xl font-bold">Most Popular Menu</h1>
         <div style="width: 100%; height: 320px;">
             <canvas id="menuChart"></canvas>
         </div>
     </div>
     @push('scripts')
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
         <script>
             var ctxMenu = document.getElementById('menuChart').getContext('2d');
             var mostMenuChart = new Chart(ctxMenu, {
                 type: 'doughnut',
                 data: {
                     labels: @json($mostMenu->pluck('name')),
                     datasets: [{
                         label: 'Total Bought',
                         data: @json($mostMenu->pluck('total_bought')),
                         backgroundColor: [
                             'rgba(255, 99, 132, 0.2)',
                             'rgba(54, 162, 235, 0.2)',
                             'rgba(255, 206, 86, 0.2)',
                             'rgba(75, 192, 192, 0.2)',
                             'rgba(153, 102, 255, 0.2)'
                         ],
                         borderColor: [
                             'rgba(255, 99, 132, 1)',
                             'rgba(54, 162, 235, 1)',
                             'rgba(255, 206, 86, 1)',
                             'rgba(75, 192, 192, 1)',
                             'rgba(153, 102, 255, 1)'
                         ],
                         borderWidth: 1
                     }]
                 },
                 options: {
                     responsive: true,
                     maintainAspectRatio: false,
                     plugins: {
                         legend: {
                             position: 'top',
                         },
                         title: {
                             display: true,
                             text: 'Most Bought Menu Items'
                         }
                     }
                 }
             });
         </script>
     @endpush
 </div>
