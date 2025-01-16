document.addEventListener('DOMContentLoaded', async () => {
    try {
        // Panggil API untuk Repair Progress
        const response = await fetch('api/get_repair_progress.php'); // Ganti dengan URL PHP Anda
        const data = await response.json();

        // Debug: Periksa data yang diterima
        console.log('Repair Progress Data:', data);

        // Data untuk Statistik Repair Progress
        const statistics = data.statistics;
        if (statistics && statistics.length > 0) {
            const dates = statistics.map(item => item.repair_date);
            const totalCompleted = statistics.map(item => item.total_completed);
            const totalInProgress = statistics.map(item => item.total_in_progress);
            const totalPending = statistics.map(item => item.total_pending);

            // Konfigurasi grafik Repair Progress Statistik
            const repairChartOptions = {
                series: [
                    { name: 'Completed', data: totalCompleted },
                    { name: 'In Progress', data: totalInProgress },
                    { name: 'Pending', data: totalPending },
                ],
                chart: {
                    type: 'bar',
                    height: 300
                },
                xaxis: {
                    categories: dates,
                    title: {
                        text: 'Repair Dates'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Count'
                    }
                },
                colors: ['#28a745', '#ffc107', '#dc3545'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                legend: {
                    show: true,
                    position: 'top'
                }
            };

            // Render grafik Repair Progress Statistik
            const repairChart = new ApexCharts(
                document.querySelector("#sales-chart"), // Pastikan elemen ini ada di HTML
                repairChartOptions
            );
            repairChart.render();
        }

        // Data Repair Progress Individual
        const tableBody = document.querySelector('#repair-progress-table-body'); // Pastikan elemen ini ada di HTML
        if (tableBody && data.data.length > 0) {
            tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi
            data.data.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.repair_date}</td>
                        <td>${item.completed}</td>
                        <td>${item.in_progress}</td>
                        <td>${item.pending}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }
    } catch (error) {
        console.error('Error fetching repair progress data:', error);
    }
});


