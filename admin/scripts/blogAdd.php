<?php
include("./db.php");
try {
    // Check if the request contains POST data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the JSON data from the request body
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $allowedCategories = ['RTO', 'Car', 'Bike'];

        if ($data !== null && isset($data['blog'])) {
            // Extract the "blog" data from the JSON
            foreach ($data['blog'] as $b) {
                if ($b['type'] == "image") {
                    $img = $b['data']['file']['url'];
                    break;
                } else {
                    $img = "asset/fallback.jpg";
                }
            }
            $blog = json_encode($data['blog']);
            $title = json_encode($data['title']);
            $url = str_replace(' ', '-', $data['url']);
            $keywords = json_encode($data['keywords']);
            $description = json_encode($data['desc']);
            $author = json_encode($data['author']);
            $category = json_encode($data['category']);

            // SQL query to insert data
            $sql = "INSERT INTO blogs (title,description,keyword,author,blog,url,imgUrl,category) VALUES (:title,:description,:keyword,$author,:blog,:url,:imgUrl,$category)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':blog', $blog);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':keyword', $keywords);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':imgUrl', $img);

            // Execute the query
            $stmt->execute();

            echo "Data inserted successfully!";
        } else {
            echo "Invalid or missing JSON data.";
        }
    } else {
        echo "No POST data received.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;