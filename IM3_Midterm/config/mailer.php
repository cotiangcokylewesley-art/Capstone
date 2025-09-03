<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "C:\\Users\\Fulmi\\vendor\\autoload.php";


$mail = new PHPMailer(true);

// Uncomment this line for debugging
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Set mailer to use SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;

// SMTP server settings
$mail->Host = 'smtp.gmail.com';     
$mail->Username = 'wesleykyle20@gmail.com';   
$mail->Password = 'upki ryog iell orwy';  
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
$mail->Port = 587;                    

$mail->isHTML(true);

return $mail;
?>