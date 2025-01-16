<?php
// Sambungan ke MySQL
$conn = new mysqli("localhost", "root", "", "dashboard_db");

// Periksa sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $full_name = $conn->real_escape_string($_POST['full-name']);
    $email = $conn->real_escape_string($_POST['email']);
    $report_title = $conn->real_escape_string($_POST['report-title']);
    $report_date = $conn->real_escape_string($_POST['date']);
    $model_name = $conn->real_escape_string($_POST['model-name']);
    $serial_number = $conn->real_escape_string($_POST['serial-number']);
    $report_description = $conn->real_escape_string($_POST['report-description']);

    // Query untuk memasukkan data ke dalam tabel `customer_reports`
    $sql = "INSERT INTO customer_reports (full_name, email, report_title, report_date, model, serial_number, description)
            VALUES ('$full_name', '$email', '$report_title', '$report_date', '$model_name', '$serial_number', '$report_description')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup sambungan
$conn->close();
?>

