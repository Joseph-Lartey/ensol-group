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
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = MAIL_PORT;
    
    // Enable debug output for troubleshooting (disable in production)
    // $mail->SMTPDebug = 2;
    
    // Recipients
    $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
    $mail->addAddress(MAIL_TO, 'Ensol Group HR');
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
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .container {
                max-width: 600px;
                margin: 30px auto;
                background: #ffffff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .header {
                background: linear-gradient(135deg, #DC1609 0%, #b01207 100%);
                color: white;
                padding: 30px 40px;
                text-align: center;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
                font-weight: 600;
            }
            .content {
                padding: 40px;
            }
            .field {
                margin-bottom: 25px;
                border-left: 3px solid #DC1609;
                padding-left: 20px;
            }
            .label {
                font-weight: 600;
                color: #DC1609;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 5px;
            }
            .value {
                color: #333;
                font-size: 15px;
                word-wrap: break-word;
            }
            .message-box {
                background: #f8f9fa;
                border-radius: 6px;
                padding: 20px;
                margin-top: 10px;
                border: 1px solid #e9ecef;
            }
            .footer {
                background: #f8f9fa;
                padding: 20px 40px;
                text-align: center;
                font-size: 12px;
                color: #666;
                border-top: 1px solid #e9ecef;
            }
            .badge {
                display: inline-block;
                background: #DC1609;
                color: white;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Contact Form Submission</h1>
                <div style="margin-top: 10px;">
                    <span class="badge">Website Inquiry</span>
                </div>
            </div>
            <div class="content">
                <div class="field">
                    <div class="label">From</div>
                    <div class="value"><strong>' . $name . '</strong></div>
                </div>
                
                <div class="field">
                    <div class="label">Email Address</div>
                    <div class="value"><a href="mailto:' . $email . '" style="color: #DC1609; text-decoration: none;">' . $email . '</a></div>
                </div>
                
                <div class="field">
                    <div class="label">Message</div>
                    <div class="message-box">' . nl2br($message_text) . '</div>
                </div>
            </div>
            <div class="footer">
                <p style="margin: 0;">This message was sent from the <strong>Ensol Group</strong> website contact form.</p>
                <p style="margin: 5px 0 0 0; color: #999;">Please respond directly to: ' . $email . '</p>
            </div>
        </div>
    </body>
    </html>';
    
    // Plain text alternative
    $mail->AltBody = "New Contact Form Submission\n\n" .
                     "From: $name\n" .
                     "Email: $email\n\n" .
                     "Message:\n$message_text";
    
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
