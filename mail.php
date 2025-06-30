<?php
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ((isset($_POST['submit']))) {

    if(empty($_POST['email'])){
        echo 'enter email';
        echo '<br>';
        exit;
        
    } else {
        $email = $_POST['email'];
    }

    if(empty($_POST['subject'])){
        echo 'enter subject';
        echo '<br>';
        exit;
    } else {
        $subject = $_POST['subject'];
    } 

     if(empty($_POST['content'])){
        echo 'enter content';
        echo '<br>';
        exit;
        
    } else {
         $content = $_POST['content'];
    } 
    

    try {

            $mail = new PHPMailer(true);

            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;            // Enable debug output (use DEBUG_OFF in production)
            $mail->isSMTP();                                  // Use SMTP
            $mail->Host       = 'smtp.gmail.com';           // Your SMTP server (e.g., smtp.gmail.com)
            $mail->SMTPAuth   = true;                         // Enable SMTP authentication
            $mail->Username   = 'sounderrajan@zeoner.com';           // Your email address
            $mail->Password   = 'mpbbygcyaqribwbi';                     // Your email password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Use 'ssl' (465) or 'tls' (587)
            $mail->Port       = 465;                          // SMTP port

            // Recipients
            // $mail->setFrom('prapha@zeoner.com', 'Your Name');      // Sender
            $mail->addAddress($email, 'Receiver'); // Receiver

            // Content
            $mail->isHTML(true);                                // Email format is HTML
            $mail->Subject = $subject;
            $mail->Body    = $content;
            $mail->AltBody = 'This is a plain text version of the email.';

            $mail->send(); // 🟢 Send the email
            echo 'Message has been sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}

?>

