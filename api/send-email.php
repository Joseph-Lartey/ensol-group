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
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
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
    $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
    $mail->addAddress(MAIL_TO);
    $mail->addReplyTo($email, $name);
    
    // Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = '[Website Enquiry] New Message from ' . $name . ' - Action Required';
    
    // Beautiful HTML email template
    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; }
            .container { max-width: 600px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; }
            .header { background: #DC1609; color: white; padding: 10px 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
            .label { font-weight: bold; color: #DC1609; }
            .footer { font-size: 12px; color: #666; text-align: center; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>New Website Inquiry</h2>
            </div>
            <div class="content">
                <div class="field">
                    <div class="label">From Name:</div>
                    <div>' . $name . '</div>
                </div>
                <div class="field">
                    <div class="label">Email Address:</div>
                    <div><a href="mailto:' . $email . '">' . $email . '</a></div>
                </div>
                <div class="field">
                    <div class="label">Message:</div>
                    <div>' . nl2br($message_text) . '</div>
                </div>
            </div>
            <div class="footer">
                <p>Sent from Ensol Group Website Contact Form</p>
            </div>
        </div>
    </body>
    </html>';
    
    $mail->AltBody = "New Inquiry\n\nFrom: $name\nEmail: $email\n\nMessage:\n$message_text";
    
    $mail->send();
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us! We will get back to you soon.'
    ]);
    
} catch (Exception $e) {
    error_log('Email sending failed: ' . $mail->ErrorInfo);
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again later.'
    ]);
}
?>
