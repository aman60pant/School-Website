<?php
include 'dbconnect.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Fetch the user by exact column case
    $query = "SELECT * FROM users WHERE Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['Id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 120px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 36px 24px;
            background: #fff;
        }

        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <?php include 'include/header.php' ?>
    <div class="login-container">
        <h2 class="text-center">User Login</h2>
        <?php
        if (isset($login_error)) {
            echo '<div class="alert alert-danger">' . $login_error . '</div>';
        }
        ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginEmail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <a href="registration_form.php">Register</a></p>
    </div>
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>