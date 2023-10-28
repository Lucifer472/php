<?php
include("./db.php");

try { // SQL query to select all data from the questionbank table
    $sql = "SELECT * FROM questionbank";

    // Execute the query
    $stmt = $conn->query($sql);

    // Fetch all the rows as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;