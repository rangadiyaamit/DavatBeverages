<?php
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rangadiyaamit7603@gmail.com';
    $mail->Password   = 'yzrtqukgpylczhel';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    // chvdamanoj123@gmail.com
    //virang.t2005@gmail.com

    for ($i = 0; $i < 20; $i++) {

        $mail->setFrom('virang.t2005@gmail.com', 'Mailer');
        $mail->addAddress('virang.t2005@gmail.com', 'Joe User');
        $mail->isHTML(true);
        $mail->Subject = 'chodu manij chandu';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        if ($mail->send()) {
            echo 'Message has been sent';
        }
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
