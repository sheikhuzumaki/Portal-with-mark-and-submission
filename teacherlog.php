<?php

  session_start();

  error_reporting(0);

  define('tportal', 'https://localhost/Portal/teacherportal.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');
 
  if ($_GET['Submit']) {
    $email = $_GET['email'];
    $pass = $_GET['password'];
    $class = $_GET['class'];
    $query = "SELECT * FROM teacher WHERE email = '$email' && pass = '$pass'";
    $data  = mysqli_query($conn , $query);
    $log = mysqli_num_rows($data);
   // echo $result['id'];
   if (empty($email) || empty($pass) ) {
      echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
   }else{
     if ($log == 1) {
         $_SESSION['email'] = $email;
         header('Location: '.tportal.'');
    }else{
        echo '<script type="text/javascript">alert("Log In Unsuccessful")</script>';
    }
   }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Teacher Log In</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Teacher Log In</h1>
        <form method="GET" action="register.php">
          <input type="submit" name="back" class="btn btn-danger" value="Sign Up">
        </form>
      </div>
    </nav>
    <br>
    <div class="container">
      <form>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control-file">
        </div>
      
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="Submit" class="btn btn-dark form-control-file">
        </div>
      </form>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>