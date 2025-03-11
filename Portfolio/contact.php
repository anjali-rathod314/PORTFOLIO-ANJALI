<?php
// Report all errors during development (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include Composer autoloader if available
require_once __DIR__ . '/vendor/autoload.php';

// Import PHPMailer classes at the global scope
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Configuration settings - in production, move this to a file outside web root
$config = [
    // Database settings
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'contact_form',
    
    // Email settings
    'smtp_host' => 'smtp.gmail.com',
    'smtp_user' => 'anjalirathod314@gmail.com', // Change to your email
    'smtp_pass' => 'jwpg pems vtox qoiz',    // Change to your app password
    'email_to'  => 'anjalirathod314@gmail.com'  // Change to recipient email
];

// Validate required fields
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    echo "<script>
            alert('Please fill in all required fields.');
            window.history.back();
          </script>";
    exit;
}

// Validate email format
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('Please enter a valid email address.');
            window.history.back();
          </script>";
    exit;
}

// Get form data and sanitize
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars(!empty($_POST['subject']) ? $_POST['subject'] : 'Contact Form Submission');
$message = htmlspecialchars($_POST['message']);
$submission_date = date('Y-m-d H:i:s');
$ip_address = $_SERVER['REMOTE_ADDR'];

// Create database connection
$db_success = false;
try {
    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO submissions (name, email, subject, message, submission_date, ip_address) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssssss", $name, $email, $subject, $message, $submission_date, $ip_address);
    
    // Execute database query
    $db_success = $stmt->execute();
    if (!$db_success) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close();
} catch (Exception $e) {
    // Log the error but don't expose details to the user
    error_log("Database error: " . $e->getMessage());
}

// Send email
$mail_success = false;

// Define fallback email function if needed
function send_basic_email($to, $subject, $message, $headers) {
    return mail($to, $subject, $message, $headers);
}

try {
    // Check if PHPMailer is available
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        // Use PHPMailer
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_user'];
        $mail->Password   = $config['smtp_pass'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom($config['smtp_user'], $name . ' via Contact Form');
        $mail->addAddress($config['email_to']);
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = "Contact Form: $name <$email> - $subject";
        
        // HTML body
        $mail->Body = "
        <h2>New message from your website contact form</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
        <p><strong>Submitted on:</strong> $submission_date</p>
        <p><strong>IP Address:</strong> $ip_address</p>
        ";
        
        // Plain text alternative
        $mail->AltBody = "New message from your website:\n\n" .
                       "Name: $name\n" .
                       "Email: $email\n" .
                       "Subject: $subject\n" .
                       "Message: $message\n" .
                       "Submitted on: $submission_date\n" .
                       "IP Address: $ip_address";
        
        $mail_success = $mail->send();
    } else {
        // Fallback to PHP's mail function
        $to = $config['email_to'];
        $email_subject = "Contact Form: $name <$email> - $subject";
        $email_body = "New message from your website:\n\n" .
                     "Name: $name\n" .
                     "Email: $email\n" .
                     "Subject: $subject\n" .
                     "Message: $message\n" .
                     "Submitted on: $submission_date\n" .
                     "IP Address: $ip_address";
        $headers = "From: {$config['smtp_user']}\r\n" .
                  "Reply-To: $email\r\n" .
                  "X-Mailer: PHP/" . phpversion();
        
        $mail_success = send_basic_email($to, $email_subject, $email_body, $headers);
    }
} catch (Exception $e) {
    // Log the error
    error_log("Email error: " . ($mail->ErrorInfo ?? $e->getMessage()));
}

// Close database connection if it was opened
if (isset($conn) && $conn) {
    $conn->close();
}

// Final response to the user
if ($db_success && $mail_success) {
    echo "<script>
            alert('Thank you! Your message has been sent successfully.');
            window.location.href = 'index.php';
          </script>";
} elseif ($db_success) {
    echo "<script>
            alert('Your information was saved, but there was an issue sending the email. We will still review your message.');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('We apologize, but there was a problem processing your submission. Please try again later.');
            window.location.href = 'index.php';
          </script>";
}
?>