<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'droopyknot4@gmail.com';
    $mail->Password = 'ilesanmiboluwatito 1';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('droopyknot4@gmail.com', 'Contact Form');
    $mail->addAddress('droopyknot4@gmail.com');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = "
        <strong>Name:</strong> {$name}<br>
        <strong>Email:</strong> {$email}<br><br>
        <strong>Message:</strong><br>{$message}
    ";

    $mail->send();
    echo 'Message sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
