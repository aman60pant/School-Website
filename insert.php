<?php
// Session check aur start
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection include karlo
require 'dbconnect.php';

// Sirf jab user logged in hai aur form POST hua ho
if (isset($_SESSION['user_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data fetch karo
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');

    // SQL Query
    $sql = "INSERT INTO contact(name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script> alert('Data submitted successfully!');
        window.location='index.php';
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "<script>
    alert('User not logged in or invalid request. Please login first.');
    window.location='login_form.php';
    </script>";
}
