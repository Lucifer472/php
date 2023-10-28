<?php
$uri = $_SERVER['REQUEST_URI'];

// Parse the URL to extract path and query
$parsedUrl = parse_url($uri);

// Get the path from the parsed URL
$path = $parsedUrl['path'];

// Remove the leading and trailing slashes from the path
$pathWithoutSlashes = trim($path, '/');

// Extract the slug from the path
$slug = explode('/', $pathWithoutSlashes)[1]; // Assuming the slug is the second part after 'blog'

if (!empty($slug)) {
    // A slug is provided, open blog.php
    include('blog.php');
} else {
    // No slug provided, open list.php
    include('list.php');
}