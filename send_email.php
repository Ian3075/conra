<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $message = htmlspecialchars($data['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Set your email address
    $to = "conradie.ian2@gmail.com";  
    $subject = "New Message from Portfolio Contact Form";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message\n";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message. Please try again later.";
    }
} else {
    echo "No data received.";
}
?>
