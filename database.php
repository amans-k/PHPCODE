<?php
$conn = new mysqli("localhost","root","","bca26");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>