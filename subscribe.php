<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the submitted email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate the email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Example: Save the email to a file or database
        $file = 'subscribers.txt';
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Redirect or display a success message
        echo "Thank you for subscribing to our newsletter!";
    } else {
        // Handle invalid email
        echo "Please enter a valid email address.";
    }
}
?>
