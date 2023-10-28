<?php
session_start(); // Start the session
include("../config.php");
include("./scripts/db.php");

// Google reCAPTCHA API keys settings
$secretKey = '6LfMMLsoAAAAAHmwWGX1t_LgvNsyufl5-d7yEzN_';

$status = 'error';
$statusMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        // Verify the reCAPTCHA response
        $url1 = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
        ];
        $options = [
            'http' => [
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url1, false, $context);
        $responseData = json_decode($response);

        if ($responseData->success) {
            $status = 'success';
            $statusMsg = 'Please Check You Password or Email.';

            $email = $_POST["email"];
            $password = $_POST["password"];
            if ($email === "hs@admin.com" && $password === "test@123") {
                $_SESSION["email"] = $email;
            }
        } else {
            $statusMsg = 'Robot verification failed, please try again.';
        }
    } else {
        $statusMsg = 'Please check the reCAPTCHA checkbox.';
    }
}
$_SESSION['statusMsg'] = $statusMsg;
header('Location: ' . $url . '/admin');