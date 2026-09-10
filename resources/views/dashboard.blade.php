<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Grafik Jenis Kelamin -->
                <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg flex flex-col">
                    <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">Jenis Kelamin</h3>
                    <div class="relative w-full h-80">
                        <canvas id="sexChart"></canvas>
                    </div>
                </div>

                <!-- Grafik Usia -->
                <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg flex flex-col">
                    <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">Distribusi Usia</h3>
                    <div class="relative w-full h-80">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>

                <!-- Grafik Pendidikan Terakhir -->
                <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg flex flex-col">
                    <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">Pendidikan Terakhir</h3>
                    <div class="relative w-full h-80">
                        <canvas id="lastEducationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sexData = @json($sex);
        const ageData = @json($age);
        const lastEducationData = @json($last_education);

        // Chart Jenis Kelamin (2 Warna: Biru untuk Laki-laki, Pink untuk Perempuan)
        new Chart(document.getElementById('sexChart'), {
            type: 'bar',
            data: {
                labels: sexData.map(item => item.sex === 'L' ? 'Laki-laki' : 'Perempuan'),
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: sexData.map(item => item.total),
                    backgroundColor: sexData.map(item => item.sex === 'L' ? '#3b82f6' : '#ec4899'),
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        // Chart Usia
        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: ageData.map(item => item.age + ' Thn'),
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: ageData.map(item => item.total),
                    backgroundColor: '#f59e0b',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        // Chart Pendidikan Terakhir (5 Warna Berbeda Sesuai Tingkat Pendidikan)
        const eduColors = {
            'SMA': '#ef4444',
            'D3': '#f59e0b',
            'D4': '#10b981',
            'S1': '#3b82f6',
            'S2': '#8b5cf6'
        };

        new Chart(document.getElementById('lastEducationChart'), {
            type: 'bar',
            data: {
                labels: lastEducationData.map(item => item.last_education),
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: lastEducationData.map(item => item.total),
                    backgroundColor: lastEducationData.map(item => eduColors[item.last_education] || '#6b7280'),
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>
</x-app-layout>