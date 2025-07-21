<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "new_db_testing";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"; // You can remove or comment this line after testing
?>
