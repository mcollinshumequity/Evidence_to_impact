<?php
/**
 * Form Handler for Evidence to Impact Consulting
 * Handles "Partner With Us" and contact form submissions.
 */

// Basic configuration
$to_email = "hello@evidencetoimpact.com";
$subject_prefix = "New Contact Request: ";

// Security: Prevent direct access via GET
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

// Get and sanitize form data
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$organization = isset($_POST['organization']) ? strip_tags(trim($_POST['organization'])) : 'Not specified';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Simple validation
if (empty($name) || empty($email) || empty($message)) {
    // Redirect with error
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&reason=missing_fields");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Redirect with error
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&reason=invalid_email");
    exit;
}

// Prepare email content
$subject = $subject_prefix . $name;
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Organization: $organization\n\n";
$email_content .= "Message:\n$message\n";

// Email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Attempt to send email
// Note: This requires a configured mail server on the hosting environment.
$mail_sent = @mail($to_email, $subject, $email_content, $headers);

// Log the submission (useful for debugging or if mail fails)
$log_entry = date('[Y-m-d H:i:s]') . " From: $name ($email) - Org: $organization - Msg: " . str_replace("\n", " ", $message) . "\n";
file_put_contents('submissions.log', $log_entry, FILE_APPEND);

// Redirect based on result
if ($mail_sent) {
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
} else {
    // Even if mail fails, we logged it, but we might want to tell the user there was a slight delay
    // or just say success if we're confident in the logging. 
    // For now, let's treat mail failure as an error for the UI.
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error&reason=server_error");
}
exit;
?>
