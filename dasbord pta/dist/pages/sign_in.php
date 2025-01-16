<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "dashboard_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Query to get the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            header('Location: dashbord_pta.php'); // Redirect to dashboard
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTA Admin</title>
    <link rel="stylesheet" href="style_sign_in.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="form sign_in">
                <h3>Sign In</h3>
                <span>or use your account</span>
                <form action="sign_in.php" method="post">
                    <div class="type">
                        <input type="email" placeholder="Enter your email" name="email" id="email" required>
                    </div>
                    <div class="type">
                        <input type="password" placeholder="Enter your password" name="password" id="password" required>
                    </div>
                    <div class="forgot">
                        <span>Forgot your password?</span>
                    </div>
                    <button class="btn bkg">Sign In</button>
                </form>
                <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            </div>
        </div>
        <div class="overlay">
            <div class="page page_signIn">
                <h3>Welcome Back!</h3>
                <p>To keep with us, please login with your personal info</p>
            </div>
        </div>
    </div>
</body>
</html>
