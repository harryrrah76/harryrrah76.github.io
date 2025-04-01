<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    $to = "harryrrah0706@gmail.com"; // Replace with your actual email
    $subject = "New Contact Form Submission from $fullname";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        http_response_code(400);
        exit;
    }
    
    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    http_response_code(405);
}
