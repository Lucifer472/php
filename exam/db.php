<?php
// Database connection details
$host = 'localhost';
$username = 'u688395736_rtoexam';
$password = 'Truepub78#k';
$database = 'u688395736_rtoexam';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}