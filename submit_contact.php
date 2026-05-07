<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        header('Location: contact.php?error=Please fill in all required fields');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: contact.php?error=Invalid email address');
        exit;
    }

    // Save to database
    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $subject, $message]);

        // Send email notification (optional)
        $to = "info@studiokelly.com";
        $email_subject = "New Contact Form Submission: $subject";
        $email_body = "You have received a new message from your website contact form.\n\n".
                      "Name: $name\n".
                      "Email: $email\n".
                      "Phone: $phone\n".
                      "Subject: $subject\n".
                      "Message:\n$message";
        $headers = "From: $email";

        mail($to, $email_subject, $email_body, $headers);

        header('Location: contact.php?success=Thank you for your message! We will get back to you soon.');
    } catch(PDOException $e) {
        header('Location: contact.php?error=There was an error submitting your message. Please try again later.');
    }
} else {
    header('Location: contact.php');
}
?>