<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'yourgmail@gmail.com'; // Your Gmail address
        $mail->Password = 'yourpassword'; // Your Gmail password or App-specific password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('danielmaangi@gmail.com'); // The email where you want to receive messages

        // Email subject & body
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "<h2>Contact Request</h2>
                        <p><strong>Name:</strong> {$name}</p>
                        <p><strong>Email:</strong> {$email}</p>
                        <p><strong>Message:</strong><br>{$message}</p>";

        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
