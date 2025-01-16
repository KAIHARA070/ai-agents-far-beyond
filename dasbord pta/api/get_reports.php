<?php
// Sambungan ke MySQL
$conn = new mysqli("localhost", "root", "", "dashboard_db");

// Periksa sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil jumlah laporan
$sql = "SELECT COUNT(*) as report_count FROM customer_reports";
$result = $conn->query($sql);
$count = $result->fetch_assoc();

// Ambil statistik laporan per tanggal
$sql = "SELECT report_date, COUNT(*) as daily_count FROM customer_reports GROUP BY report_date";
$result_statistic = $conn->query($sql);
$statistics = [];
if ($result_statistic->num_rows > 0) {
    while ($row = $result_statistic->fetch_assoc()) {
        $statistics[] = $row;
    }
}

// Gabungkan data
$response = [
    'report_count' => $count['report_count'],
    'statistics' => $statistics,
    'reports' => []
];

// Ambil data laporan
$sql = "SELECT full_name, email, report_title, report_date, model, serial_number, description FROM customer_reports";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response['reports'][] = $row;
    }
}

// Hantar data sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup sambungan
$conn->close();
?>
