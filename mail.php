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

//$mail->SMTPDebug = 3;                             

$mail->isSMTP();                                   
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true;                              
$mail->Username = 'divya*******@gmail.com';            
$mail->Password = '*****';                          
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587; 

$mail->setFrom('divya*****@gmail.com', 'Mailer');
     

$mail->addAddress($row["email"]);
 }
       // Add a recipient

$mail->isHTML(true);                                 

$mail->Subject = 'thank you';
$mail->Body    = "your email is:'".$row['email']."',your password is: '".$row['password']."'";

$mail->AltBody = 'thanku';
if($mail->send()){
         echo'mail has been sent';
  
  }
  else {
  
     echo 'Mailer Error: ' . $mail->ErrorInfo;
}

 }                  

?>         




