<?php
// Initialize a feedback message
$message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $userMessage = htmlspecialchars($_POST['message'] ?? '');

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address. Please provide a valid email.";
    } else {
        // Prepare the email details
        $to = "info@hilley-consultants.com";
        $emailSubject = "Contact Form Submission: $subject";
        $emailBody = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage:\n$userMessage";
        $headers = "From: $email";

        // Attempt to send the email
        if (mail($to, $emailSubject, $emailBody, $headers)) {
            $message = "Message sent successfully! We will get back to you soon.";
        } else {
            $message = "Failed to send the message. Please try again later.";
        }
    }

    // Redirect back to the form with a message
    header("Location: index.php?msg=" . urlencode($message));
    exit;
} else {
    // If the form was not submitted, show a generic error
    $message = "Invalid request.";
    header("Location: index.php?msg=" . urlencode($message));
    exit;
}
?>
