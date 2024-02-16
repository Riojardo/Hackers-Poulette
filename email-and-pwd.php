<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {

    function random_pwd (){

        $letter = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_+=~[]{}|;:,.<>?';";
        $letter_Array = str_split($letter);
        $password ="";
    
        for ($i=0;$i<12;$i++){
           $index_rand = rand(0,count($letter_Array) - 1);
           $password .= $letter_Array[$index_rand];
    
        }
    return $password;
    }

    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $password_client = random_pwd();
    $email = $_POST['email'];
    $mail = new PHPMailer(true);
    
try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'robin.jardon@gmail.com';
        $mail->Password = 'eitg vabi rdqi stgw';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
            
        $mail->setFrom('robin.jardon@gmail.com','Rob Jardon');
        $mail->addAddress($email, $FirstName . ' ' . $LastName);

        $mail->isHTML(true);
        $mail->Subject = 'hacker-poulet verification';
        $mail->Body = "Dear $FirstName $LastName, here is your password: $password_client";
        $mail->send();
        echo $email;
        echo "Email sent successfully.";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>