
<?php
$host = "localhost";       // Server
$username = "root";        // MySQL username (default for XAMPP/WAMP)
$password = "";            // MySQL password (default for XAMPP/WAMP is empty)
$database = "aqi";         // The correct database name (your database)

$conn = new mysqli($host, $username, $password, $database);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
