<?php
$servername = "localhost";
$username = "root"; 
$password = "ipsleisha1703"; 
$dbname = "expense_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
