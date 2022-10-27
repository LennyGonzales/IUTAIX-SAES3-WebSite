<?php

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebub = SMTP::DEBUG_SERVER;

    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025;

    $mail->Charet = "utf-8";

    $mail->addAdresse("ganassialex@gmail.com");

    $mail->SetFrom("ganassialex@gmail.com");

    $mail->Subject = "sujet du message";
    $mail->Body = "Coucou";

    $mail->send();
    echo "message envoyer";
}catch (Exception){
    echo "Message non envoyé, Erreur: {$mail->ErrorInfo}";
}




// $to = "ganassialex@gmail.com";
// $subject = "sujet";
// $message = 'massage';
// $headers = [
//        "From" => "ganassialex@gmail.com"
//];
//mail($to, $subject, $message, $headers);