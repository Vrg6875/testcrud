<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "testcrud";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn) {
    echo "connected";
} else {
    die("Connection failed: " . mysqli_connect_error());
}
?>
