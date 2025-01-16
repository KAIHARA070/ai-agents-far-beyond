document.addEventListener('DOMContentLoaded', async () => {
    try {
        // Panggil API untuk Customer Report
        const responseReports = await fetch('api/get_reports.php');
        const dataReports = await responseReports.json();

        // Debug: Periksa data Customer Report
        console.log('Customer Report Data:', dataReports);

        // Tampilkan jumlah laporan (jika diperlukan)
        const reportCountElement = document.querySelector('#report_count');
        if (reportCountElement && dataReports.report_count) {
            reportCountElement.textContent = dataReports.report_count;
        }

        // Masukkan data laporan ke tabel Customer Reports
        const tableBody = document.querySelector('#customer-reports-table-body');
        if (tableBody && dataReports.reports.length > 0) {
            tableBody.innerHTML = ''; // Kosongkan tabel sebelum mengisi
            dataReports.reports.forEach(report => {
                const row = `
                    <tr>
                        <td>${report.full_name}</td>
                        <td>${report.email}</td>
                        <td>${report.report_title}</td>
                        <td>${report.report_date}</td>
                        <td>${report.model}</td>
                        <td>${report.serial_number}</td>
                        <td>${report.description}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Tampilkan statistik pada grafik Customer Report Statistic
        if (dataReports.statistics && dataReports.statistics.length > 0) {
            const categories = dataReports.statistics.map(stat => stat.report_date);
            const seriesData = dataReports.statistics.map(stat => stat.daily_count);

            const visitors_chart_options = {
                series: [
                    {
                        name: "Report Count",
                        data: seriesData,
                    },
                ],
                chart: {
                    height: 200,
                    type: "line",
                    toolbar: { show: false },
                },
                colors: ["#0d6efd"],
                stroke: { curve: "smooth" },
                grid: {
                    borderColor: "#e7e7e7",
                    row: { colors: ["#f3f3f3", "transparent"], opacity: 0.5 },
                },
                xaxis: { categories: categories },
            };

            const visitors_chart = new ApexCharts(
                document.querySelector("#visitors-chart"),
                visitors_chart_options
            );
            visitors_chart.render();
        }

        // Panggil API untuk Repair Progress
        const responseRepairProgress = await fetch('api/get_repair_progress.php');
        const dataRepairProgress = await responseRepairProgress.json();

        // Debug: Periksa data Repair Progress
        console.log('Repair Progress Data:', dataRepairProgress);

        // Data untuk Statistik Repair Progress
        const statistics = dataRepairProgress.statistics;
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
        const tableBodyRepair = document.querySelector('#repair-progress-table-body'); // Pastikan elemen ini ada di HTML
        if (tableBodyRepair && dataRepairProgress.data.length > 0) {
            tableBodyRepair.innerHTML = ''; // Kosongkan tabel sebelum mengisi
            dataRepairProgress.data.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.repair_date}</td>
                        <td>${item.completed}</td>
                        <td>${item.in_progress}</td>
                        <td>${item.pending}</td>
                    </tr>
                `;
                tableBodyRepair.innerHTML += row;
            });
        }

        // Navigasi tombol aktif
        const menu = document.getElementById("navigationMenu");
        const buttons = menu.getElementsByClassName("btn");

        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function () {
                // Hapus kelas aktif dari semua tombol
                for (let j = 0; j < buttons.length; j++) {
                    buttons[j].classList.remove("active");
                }
                // Tambahkan kelas aktif ke tombol yang diklik
                this.classList.add("active");
            });
        }

    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
