<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $organization = htmlspecialchars(trim($_POST["organization"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Check required fields
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: index.html?status=error");
        exit;
    }

    $to = "mcollinswork6@gmail.com";
    $subject = "New Partnership Inquiry from $name";
    $body = "Name: $name\nEmail: $email\nOrganization: $organization\n\nMessage:\n$message";
    
    // IMPORTANT: Emails sent from a tool pretending to be civil (like @gmail.com) are often blocked by spam filters.
    // It's best practice to send from a fixed address on your server's domain and use Reply-To for their address.
    $headers = "From: [EMAIL_ADDRESS]\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    mail($to, $subject, $body, $headers);

    // Redirect to index with success message
    header("Location: index.html?status=success");
    exit;
} else {
    // If not a POST request, redirect home
    header("Location: index.html");
    exit;
}
?>
