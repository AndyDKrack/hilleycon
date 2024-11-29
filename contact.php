<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $userMessage = htmlspecialchars($_POST['message'] ?? '');

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address. Please provide a valid email.";
        header("Location: contact.html?error=" . urlencode($error_message));
        exit;
    }

    // Prepare the email details
    $to = "info@hilley-consultants.com"; 
    $emailSubject = "Contact Form Submission: $subject";
    $emailBody = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage:\n$userMessage";
    $headers = "From: $email";

    // Attempt to send the email
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        header("Location: thankyou.html"); // Redirect to the thank-you page
        exit;
    } else {
        $error_message = "Failed to send the message. Please try again.";
        header("Location: contact.html?error=" . urlencode($error_message)); // Redirect back with error
        exit;
    }
} else {
    // If the form was not submitted, show a generic error
    $error_message = "Invalid request.";
    header("Location: contact.html?error=" . urlencode($error_message));
    exit;
}
?>
