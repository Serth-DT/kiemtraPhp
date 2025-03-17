<?php
$host = 'localhost';   
$user = 'root';       
$pass = '1234';            
$db   = 'Test1';    
$port = 3307;   

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

if (class_exists('mysqli')) {
    // echo "MySQLi extension đã được kích hoạt!";
} else {
    // echo "MySQLi extension chưa được kích hoạt!";
}
?> 