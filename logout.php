<?php
session_start(); // Start/Resume current session
session_unset(); // Unset all session variables (optional, for safety)
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: login_form.php"); // Change this to your login page filename
exit();