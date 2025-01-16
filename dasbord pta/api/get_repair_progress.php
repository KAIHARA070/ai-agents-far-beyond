<?php
// Sambungan ke MySQL
$conn = new mysqli("localhost", "root", "", "dashboard_db");

// Periksa sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil statistik repair progress per tanggal
$sql_statistics = "SELECT repair_date, 
                          SUM(completed) as total_completed, 
                          SUM(in_progress) as total_in_progress, 
                          SUM(pending) as total_pending 
                   FROM repair_progress 
                   GROUP BY repair_date";
$result_statistics = $conn->query($sql_statistics);

$statistics = [];
if ($result_statistics->num_rows > 0) {
    while ($row = $result_statistics->fetch_assoc()) {
        $statistics[] = $row;
    }
}

// Ambil data repair progress individual
$sql_data = "SELECT repair_date, completed, in_progress, pending FROM repair_progress";
$result_data = $conn->query($sql_data);

$data = [];
if ($result_data->num_rows > 0) {
    while ($row = $result_data->fetch_assoc()) {
        $data[] = $row;
    }
}

// Gabungkan data untuk response
$response = [
    'statistics' => $statistics, // Statistik repair progress
    'data' => $data              // Data repair progress individual
];

// Return data sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Tutup sambungan
$conn->close();
?>

