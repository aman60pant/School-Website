<?php
include 'dbconnect.php';

$successMsg = $errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
    // Collect and sanitize inputs
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errorMsg = "Passwords do not match!";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check = "SELECT id FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check);
        if (mysqli_num_rows($result) > 0) {
            $errorMsg = "Email already registered.";
        } else {
            $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password_hash')";
            if (mysqli_query($conn, $sql)) {
                $successMsg = "Registration successful!";
            } else {
                $errorMsg = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .register-container {
            max-width: 450px;
            margin: 60px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.09);
            padding: 36px 24px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2 class="text-center mt-3">Create Account</h2>
        <?php if ($successMsg): ?><div class="alert alert-success"><?= $successMsg ?></div><?php endif; ?>
        <?php if ($errorMsg): ?><div class="alert alert-danger"><?= $errorMsg ?></div><?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Enter password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
        </form>
        <p class="mt-3 text-center mb-0">Already have an account? <a href="login_form.php">Sign in</a></p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>