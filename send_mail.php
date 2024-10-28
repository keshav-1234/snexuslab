<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader or manually include PHPMailer files
require 'vendor/autoload.php'; // Use this if installed via Composer
// OR
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form fields
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $pincode = htmlspecialchars($_POST['pincode']);
    $service = htmlspecialchars($_POST['category']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'mail.snexuslab.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@snexuslab.com';
        $mail->Password = '2%jX4,3bItlx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipient and sender settings
        $mail->setFrom('info@snexuslab.com', 'Appointment Booking');
        $mail->addAddress('info@snexuslab.com', 'SnexusLab'); // Add more recipients if needed
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';
        $mail->Body    = "
            <h3>Appointment Details</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Address:</strong> $address</p>
            <p><strong>Pincode:</strong> $pincode</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Time:</strong> $time</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send email
        $mail->send();
        echo 'Message has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
