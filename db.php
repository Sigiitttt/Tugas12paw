<?php
$host = 'localhost';
$user = 'root';
$pass = 'Password123!';
$dbname = 'tugas12paw';
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
