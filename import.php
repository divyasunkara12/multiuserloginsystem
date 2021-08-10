<?php
$connect = new PDO("mysql:host=localhost;dbname=multiusersystem", "root", "");
$query = "SELECT * FROM (
        SELECT * FROM users ORDER BY id DESC LIMIT 20 
         )Var1
   
   ORDER BY id ASC";
$statement = $connect->prepare($query);
$statement->execute();

?>


<!DOCTYPE html>
<html>
  <head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </head>
  <body>
    <br />
    <div class="container">
      <h3 align="center">Send email</h3>
      <br />
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <tr>
            <th>email</th>
            <th>password</th>
            <th>Select</th>
            <th>Action</th>
          </tr>
        <?php
        $count = 0;
        foreach($statement as $row)
        {
          $count = $count + 1;
          echo '
          <tr>
            <td>'.$row["email"].'</td>
            <td>'.$row["password"].'</td>
            <td>
              <input type="checkbox" name="single_select" class="single_select" data-password="'.$row["password"].'" data-email="'.$row["email"].'" />
            </td>
            <td>
            <button type="button" name="email_button" class="btn btn-info btn-xs email_button" id="'.$count.'" data-password="'.$row["password"].'" data-email="'.$row["email"].'" data-action="single">Send Single</button>
            </td>
          </tr>
          ';
        }
        ?>
          <tr>
            <td colspan="3"></td>
            <td><button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td></td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>

<script>
$(document).ready(function(){
  $('.email_button').click(function(){
    $(this).attr('disabled', 'disabled');
    var id  = $(this).attr("id");
    var action = $(this).data("action");
    var email_data = [];
    if(action == 'single')
    {
      email_data.push({
        email: $(this).data("email"),
        password: $(this).data("password")
      });
    }
    else
    {
      $('.single_select').each(function(){
        if($(this).prop("checked") == true)
        {
          email_data.push({
            email: $(this).data("email"),
            password: $(this).data('password')
          });
        } 
      });
    }

    $.ajax({
      url:"mail.php",
      method:"POST",
      data:{email_data:email_data},
      beforeSend:function(){
        $('#'+id).html('Sending...');
        $('#'+id).addClass('btn-danger');
      },
      success:function(data){
        if(data == 'ok')
        {
          $('#'+id).text('Success');
          $('#'+id).removeClass('btn-danger');
          $('#'+id).removeClass('btn-info');
          $('#'+id).addClass('btn-success');
        }
        else
        {
          $('#'+id).text(data);
        }
        $('#'+id).attr('disabled', false);
      }
    })

  });
});
</script>

   
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center">
<div class="border shadow p-3 rounded">
  <h3>logout Page</h3>
   <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p></div>
  </div>
</body>
</html>



