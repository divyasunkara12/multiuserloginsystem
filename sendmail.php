<?php
session_start();
$email = "";
$password = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'multiusersystem');

if (isset($_POST['registred_user'])) {
  $password = mysqli_real_escape_string($db, trim($_POST['password']));
  $email = mysqli_real_escape_string($db, trim($_POST['email']));
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (empty($email)) {
    array_push($errors, "email is required");
  }
  if (count($errors) == 0) {
  $sql= "SELECT * FROM users WHERE email='".$email."'";
  $rs= mysqli_query($db,$sql);
  $numrows= mysqli_Num_rows($rs);
  if($numrows>0){
    $row=mysqli_fetch_assoc($rs);
    if (password_verify($password, $row['password'])){
      echo "password verified";
       $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
      header('location: login.php');
      }
      else {
      array_push($errors, "Wrong email/password combination");
    }
    
    }  
  }

}
?>

<?php 
 require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Speify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'divya******@gmail.com';                 // SMTP username
$mail->Password = '*****';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; 

$mail->setFrom('divya*****@gmail.com', 'Mailer');
$sql= "SELECT * FROM users WHERE email='".$email."'";
  $rs= mysqli_query($db,$sql);
  $numrows= mysqli_Num_rows($rs);
  if($numrows>0){
    while($x=mysqli_fetch_assoc($rs))
       if (password_verify($password, $x['password'])){
      echo "password verified";
{
$mail->addAddress($x['email']);
 } 
       // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'thank you';
$mail->Body    = "your email is:'".$email."',your password is: '".$password."'";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}
 }                       // TCP port to connec

?>         

