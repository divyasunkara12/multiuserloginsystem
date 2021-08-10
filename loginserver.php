<?php
session_start();
$username = "";
$email = "";
$role ="";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'multiusersystem');

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db,trim($_POST['username']));
  $password = mysqli_real_escape_string($db, trim($_POST['password']));
  $email = mysqli_real_escape_string($db, trim($_POST['email']));
  $role = mysqli_real_escape_string($db, trim($_POST['role']));


  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (empty($email)) {
    array_push($errors, "email is required");
  }
  $usernamelength = mysqli_real_escape_string($db, strlen($_POST['username']));
  $passwordlength = mysqli_real_escape_string($db, strlen($_POST['password']));
   if ($usernamelength<2) { array_push($errors, "Username mustbe atleast 2 characters"); }
  if ($passwordlength<6) { array_push($errors, "Password mustbe atleast 6 characters"); }
    
    if (count($errors) == 0) {
  $sql= "SELECT * FROM users WHERE username='".$username."' &&  email='".$email."' && role='".$role."'";
  $rs= mysqli_query($db,$sql);
  $numrows= mysqli_Num_rows($rs);
  if($numrows>0){
  	 $row=mysqli_fetch_assoc($rs);
      
      if (password_verify($password, $row['password'])){
  		echo "password verified";
        }   

      if($row['role'] =='admin'){
  		 $_SESSION['user'] = $row;
       $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  		}else{
        $_SESSION['user'] = $row;
        $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: userindex.php');
    }
  }
  else {
  		array_push($errors, "Wrong username/password/email/role combination");
    }
    }  
  

}
?>
