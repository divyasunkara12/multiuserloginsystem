<?php
session_start();
$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'multiusersystem');

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $role = mysqli_real_escape_string($db, $_POST['role']);

  $options=array("cost"=>4);
  $hashpassword=password_hash($password, PASSWORD_BCRYPT,$options);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
   if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }

  }
  
  if (count($errors) == 0) {
  $query = "INSERT INTO users (username, email,role, password)
          VALUES('".$username."', '".$email."','".$role."', '".$hashpassword."')";
   $results= mysqli_query($db, $query);
   if($results)
{
  echo"registration succeesfully";
  $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: registred.php');
}  
}
  }


?>  
        
