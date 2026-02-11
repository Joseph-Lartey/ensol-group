<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate inputs
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
}

if (empty($message)) {
    $errors[] = 'Message is required';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); // For HTML Body
$name_clean = strip_tags($_POST['name']); // For Headers
$name_clean = str_replace(array("\r", "\n"), '', $name_clean); // Prevent header injection
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$message_text = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

try {
    $mail = new PHPMailer(true);
    
    // Server settings - using constants from config.php
    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;
    
    // CRITICAL for Localhost: Disable Encryption
    $mail->SMTPSecure = false;
    $mail->SMTPAutoTLS = false;
    
    $mail->Port = MAIL_PORT;
    
    // Recipients
    // USE NO NAME to bypass strict spam filters (detected by debug tests)
    $mail->setFrom(MAIL_FROM_EMAIL); 
    $mail->addAddress(MAIL_TO);
    
    // Temporarily disable Reply-To to rule out spoofing checks
    // $mail->addReplyTo($email, $name_clean);
    
    // Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'New Message: ' . $name_clean;
    
    // Simplified HTML email template to avoid spam filters
    $mail->Body = "
    <h3>New Website Inquiry</h3>
    <p><strong>Name:</strong> $name_clean</p>
    <p><strong>Email:</strong> <a href='mailto:$email'>$email</a></p>
    <p><strong>Message:</strong><br>" . nl2br($message_text) . "</p>
    <hr>
    <p><small>Sent from Ensol Group Website Contact Form</small></p>
    ";
    
    $mail->AltBody = "New Inquiry\n\nFrom: $name\nEmail: $email\n\nMessage:\n$message_text";
    
    $mail->send();
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us! We will get back to you soon.'
    ]);
    
} catch (Exception $e) {
    // Log extended error details
    $logMsg = date('[Y-m-d H:i:s] ') . "Error: " . $mail->ErrorInfo . "\n";
    file_put_contents(__DIR__ . '/email_errors.log', $logMsg, FILE_APPEND);
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again later.'
    ]);
}
?>
