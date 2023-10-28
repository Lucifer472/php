<?php
include("../config.php");
include("../admin/scripts/db.php");
function categoryFind($conn)
{
    $sql = "SHOW COLUMNS FROM blogs WHERE Field = 'category'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // Extract ENUM values from the result
    $enum_values = $result['Type'];

    // Parse ENUM values into an array
    preg_match_all("/'([^']+)'/", $enum_values, $matches);
    $values = $matches[1];

    return $values;
}
function getAllUsernames($conn)
{
    // Initialize an empty array to store usernames
    $usernames = array();

    // SQL query to fetch all usernames from the "author" table
    $sql = "SELECT username FROM author";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $usernames[] = $row;
    }
    return $usernames;
}
function getAllBlogUrls($conn)
{
    // Initialize an empty array to store URLs
    $urls = array();

    // SQL query to fetch all URLs from the "blog" table
    $sql = "SELECT url FROM blogs";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $urls[] = $row;
    }

    return $urls;
}

$cat = categoryFind($conn);
$username = getAllUsernames($conn);
$blogs = getAllBlogUrls($conn);

// $conn = null;

// Set the content type to XML
header('Content-type: application/xml');

// Output the XML declaration
echo '<?xml version="1.0" encoding="UTF-8"?>';

// Output the root element for the sitemap
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$urls = array(
    $url,
    $url . "/questionbank",
    $url . "/exam",
    $url . "/blog",
    $url . "/settings",
    $url . "/settings/contact",
);

foreach ($cat as $c) {
    $urls[] = $url . '/category/' . $c;
}

foreach ($username as $u) {
    $urls[] = $url . '/author/' . $u;
}
foreach ($blogs as $b) {
    $urls[] = $url . '/blog/' . $b;
}

// Create URL elements for each page
foreach ($urls as $url) {
    echo '<url>';

    echo '<loc>' . htmlspecialchars($url) . '</loc>';
    echo '<lastmod>' . date('c') . '</lastmod>';
    echo '<changefreq>weekly</changefreq>';
    echo '<priority>0.8</priority>';

    echo '</url>';
}

// Close the root element
echo '</urlset>';
?>