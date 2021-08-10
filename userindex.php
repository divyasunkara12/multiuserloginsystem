<?php 
  session_start(); 
 if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must register first";
    header('location: register.php');
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body><div class="container d-flex justify-content-center align-items-center">
<div class="border shadow p-3 rounded">
  <h3>Home Page</h3>
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
                        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
                <?php endif ?>
  </div>
 </body>
</html>
