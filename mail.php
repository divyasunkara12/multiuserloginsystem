<?php
$password = "";
$email    = "";

if(isset($_POST['email_data']))
{
  require 'class.phpmailer.php';
  $output = '';
  foreach($_POST['email_data'] as $row)
  {
    require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Speify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'divya*******@gmail.com';                 // SMTP username
$mail->Password = '*****';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; 

$mail->setFrom('divya*****@gmail.com', 'Mailer');
     

$mail->addAddress($row["email"]);
 }
       // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'thank you';
$mail->Body    = "your email is:'".$row['email']."',your password is: '".$row['password']."'";

$mail->AltBody = 'thanku';
if($mail->send()){
         echo'mail has been sent';
  
  }
  else {
  
     echo 'Mailer Error: ' . $mail->ErrorInfo;
}

 }                    // TCP port to connec

?>         




