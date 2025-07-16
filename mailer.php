<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['fullname'];
    $email   = $_POST['email'];
    $mobile  = $_POST['mobile'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    
    try {
        
        $mail->isSMTP();
        $mail->Host = '';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom($email, $name);
        $mail->addAddress('info@buildrich.in'); // your receiving email

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message';
        $mail->Body    = "
           <div style='font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; border-radius: 8px;'>
          <h2 style='color:#01274d;'>📩 Contact Form Submission</h2>
          <p><strong>Name:</strong> {$name}</p>
          <p><strong>Email:</strong> {$email}</p>
          <p><strong>Mobile:</strong> {$mobile}</p>
          <p><strong>Message:</strong><br>{$message}</p>
          <hr>
          <p style='font-size: 13px; color: gray;'>This message was sent from the contact form on your website.</p>
        </div>";
        $mail->send();

         // Send Auto-Reply to User
        $reply = new PHPMailer(true);
       $mail->isSMTP();
        $mail->Host = '';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $reply->setFrom('', 'Buildrich Group');
        $reply->addAddress($email, $name);

        $reply->isHTML(true);
        $reply->Subject = "Thank You for Contacting Us!";
        $reply->Body = "
        <div style='font-family: Arial, sans-serif; padding: 20px; background: #f1f8ff; border-radius: 8px;'>
          <h2 style='color:#5a83f5;'>Hello {$name},</h2>
          <p>Thank you for reaching out to us. We have received your message and will get back to you shortly.</p>
          <p><strong>Your Message:</strong><br>{$message}</p>
          <br>
          <p>Best regards,</p>
          <p><strong>Buildrich Construction Equipment</strong><br><small>support@buildrich.in</small></p>
        </div>";

        $reply->send();


        echo "<script>alert('Message sent successfully!'); window.history.back();</script>";
    } catch (Exception $e) {
        echo "Message failed. Error: {$mail->ErrorInfo}";
    }
}
?>
