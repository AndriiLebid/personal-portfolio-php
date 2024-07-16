<?php
$hostname = "localhost";
$username = "dev";
$password = "Dev1234!";
$dbName = "andrii_lebid_portfolio";

$conn = new mysqli($hostname, $username, $password, $dbName);

if($conn->connect_error){
    die("Connection failed " . $conn->connect_error);
}
?>