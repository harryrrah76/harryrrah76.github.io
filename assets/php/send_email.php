<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Collect form data from GET request
    $fullname = htmlspecialchars($_GET['fullname']);
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_GET['message']);

    // Email configuration
    $to = "your-email@example.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Message body
    $body = "<h2>New Contact Form Submission</h2>";
    $body .= "<p><strong>Name:</strong> $fullname</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Message:</strong><br>$message</p>";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message. Please try again later.";
    }
}
?>
