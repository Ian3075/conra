<?php
// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $message = htmlspecialchars($data['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $to = "conradie.ian2@gmail.com";  
    $subject = "New Message from Portfolio Contact Form";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message\n";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message. Please try again later.";
    }
} else {
    echo "No data received.";
}
?>
