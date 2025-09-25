
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set SMTP server (e.g., smtp.gmail.com)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mrabrarbabarkhan@gmail.com';   // SMTP username
        $mail->Password   = 'idim sxif vfmd wrap';     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($email, $fullname);
        $mail->addAddress('mrabrarbabarkhan@gmail.com'); // Your email
        $mail->addReplyTo($email, $fullname);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $fullname\nEmail: $email\nMessage:\n$message";

        // Disable SSL certificate verification (for testing only!)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message failed to send. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
