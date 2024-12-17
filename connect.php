<?php
$servername = "localhost"; // Replace with your server name
$username = "velma.ombiuuya";        // Replace with your database username
$password = "VelmaIdah001**";            // Replace with your database password
$dbname = "webtech_fall2024_velma_ombiuuya"; // Replace with your database name

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
