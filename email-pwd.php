<?php
// Start the session
session_start();

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$autorisation_capcha = false;
$autorisation_email = false;

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

    // Generate random password
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
        $mail->addAddress($email, " Monsieur ou Madame ");
        $mail->isHTML(true);
        $mail->Subject = 'hacker-poulet verification';
        $mail->Body = "Dear client, here is your password: $password_client";
        $mail->send();
        $_SESSION['password_client'] = $password_client;
        $_SESSION['email'] =$email;
        $autorisation_capcha = true;
        $autorisation_email = true;
    } catch (Exception $e) {
        echo '<script>alert("Email could not be sent. Mailer")</script>';      
        $autorisation_capcha = true;
    }
}




