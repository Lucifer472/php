<?php
$url = "http://localhost";
$mainTitle = "Best RTO Exam Prep";

$header = <<<EOD
<link rel="shortcut icon" href="$url/asset/logo.svg" type="image/svg">
<link rel="stylesheet" href="$url/main.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
EOD;

function truncateText($text, $maxLength)
{
  if (strlen($text) > $maxLength) {
    return substr($text, 0, $maxLength) . "...";
  } else {
    return $text;
  }
}