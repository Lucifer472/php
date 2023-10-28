<?php
include("./db.php");

try {
    $sql = "SELECT * FROM blogs ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the blogs as JSON
    header('Content-Type: application/json');
    echo json_encode($blogs);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}