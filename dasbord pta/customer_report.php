<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: sign_in.php'); // Redirect to sign-in if not logged in
    exit();
}

// Get user data from session
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTA Admin Dashboard</title>
    <link rel="stylesheet" href="adminlte1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>

    <style>
        .btn {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #adb5bd;
            background-color: transparent;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn:hover {
            background-color: #6c757d;
            color: white;
        }

        .btn.active {
            background-color: #6c757d;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #495057;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-profile h4 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .user-profile p {
            font-size: 12px;
            margin: 0;
            color: #adb5bd;
        }
    </style>
</head>
<body style="margin: 0; font-family: Arial, sans-serif;">

<!-- Header -->
<header>
    <h2>PTA Admin</h2>
    <div class="user-profile">
        <img src="default-avatar.png" alt="User Avatar">
        <div>
            <h4 id="user-name"><?php echo $user_name; ?></h4>
            <p id="user-email"><?php echo $user_email; ?></p>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside style="background-color: #343a40; color: white; height: 100vh; position: fixed; width: 250px; padding: 20px; overflow-y: auto; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);">
    <div style="text-align: center; padding: 15px; font-size: 20px; font-weight: bold; background-color: #495057; border-radius: 10px; margin-bottom: 20px;">
       Admin
    </div>

    <!-- Navigation Menu -->
    <ul id="navigationMenu" style="list-style: none; padding: 0;">
        <li>
            <a href="dashbord_pta.php" class="btn">
                <i class="bi bi-speedometer nav-icon"></i>
                Customer Report
            </a>
        </li>
        <li>
            <a href="customer_report.php" class="btn active">
                <i class="bi bi-bar-chart nav-icon"></i>
                Customer Report Statistics
            </a>
        </li>
        <li>
            <a href="repair_progress.php" class="btn">
                <i class="bi bi-tools nav-icon"></i>
                Repair Progress
            </a>
        </li>
        <li>
            <a href="./sign_in.php" class="btn">
                <i class="bi bi-box-arrow-in-right nav-icon"></i>
                Log In Page
            </a>
        </li>
        <li>
            <a href="./reportForm.html" class="btn">
                <i class="bi bi-pencil-square nav-icon"></i>
                Submit Form
            </a>
        </li>
        <li>
            <a href="./register_form.html" class="btn">
                <i class="bi bi-pencil-square nav-icon"></i>
                Register Form
            </a>
        </li>
    </ul>
</aside>





        <!-- Main Content -->
        <main style="margin-left: 300px; padding: 20px; background-color: #f8f9fa; min-height: 100vh;">
            <h3 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Admin Dashboard</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div style="flex: 1; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <h4 style="font-size: 18px; font-weight: bold; color: #495057;">Customer Report Statistic</h4>
                    <div id="visitors-chart" style="margin-top: 10px;"></div>
                </div>
 


        <!-- Footer -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <strong>Copyright &copy; 2024 <a href="#">AHMADZAHID.io</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- Tambahkan Library dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
    <script src="script.js"></script> <!-- Sambungan ke JavaScript -->
</body>
</html>
