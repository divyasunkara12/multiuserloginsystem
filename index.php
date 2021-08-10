<?php 
  session_start(); 
 if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must register first";
    header('location: register.php');
  }
  if (isset($_GET['sendmail'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: import.php");
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>
<body><div class="container d-flex justify-content-center align-items-center">
<div class="border shadow p-3 rounded">
  <h3>Admin Page</h3>
  <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h4>
          <?php 
              echo $_SESSION['success']; 
          	unset($_SESSION['success']);
		?>
	      </h4>
      </div>
      <?php endif ?>
	<?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> <a href="index.php?sendmail='1'" style="color: green;">sendmail</a> </p>
                        <p> <a href="index.php?logout='1'" style="color: green;">logout</a> </p>
                <?php endif ?>
  </div>
<?php 
$field1="";
$field2="";
$field3="";
$field4="";


$db = mysqli_connect("localhost", "root", "", "multiusersystem");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    $field1 = mysqli_real_escape_string($db, $data[0]);  
    $field2 = mysqli_real_escape_string($db, $data[1]);
    $field3 = mysqli_real_escape_string($db, $data[2]);
    $field4 = mysqli_real_escape_string($db, $data[3]);

    $options=array("cost"=>4);
  $hashpassword=password_hash($field4, PASSWORD_BCRYPT,$options);
    $query = "INSERT into users(username,email,role,password) VALUES('$field1', '$field2','$field3','$hashpassword')";
                mysqli_query($db, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
?>  
 <style>
  .box
  {
   max-width:500px;
   width:100%;
   margin: 0 auto;;
  }
  </style>
<body>
  <br/>
  <form method="post" enctype="multipart/form-data">
    <div class="container d-flex justify-content-center align-items-center">
    <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
      </div>

  </form>
  </body>
</html>

