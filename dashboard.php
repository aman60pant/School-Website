<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
    <?php include 'include/header.php' ?>
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
  <a href="logout.php">Logout</a>
</body>
</html>
