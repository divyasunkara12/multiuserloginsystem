<?php include('sendmail.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>multiuserlogin</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 75vh">
         <form class="border shadow p-3 rounded"
               action="registred.php"
                method="post" 
               style="width: 520px;">
               <h3 class="text-center p-3"> checking login</h3>
               <?php include('errors.php');?>
     <div class="mb-3">
          <label for="email" 
                 class="form-label">Email</label>
          <input type="email" 
                 class="form-control" 
                 name="email"
                 placeholder="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
          <label for="password" 
                 class="form-label">Password</label>
          <input type="password" 
                 name="password"  
                 class="form-control" minlength="6"
                placeholder="Password(6 or more characters)">
        </div>
        <center>
  	    <div class="mb-3">
  		<button type="submit" class="btn" name="registred_user">Login</button>
  	</div>
   </center>
     </div>
 </form>
</body>
</html>
