<?php

  error_reporting(0);

  define('slog', 'https://localhost/Portal/studentlog.php');
  define('tlog', 'https://localhost/Portal/teacherlog.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');
  
  if ($_POST['Submit']) {
    $Position = $_POST['Student'] ;
    $fname = $_POST['fname'] ;
    $lname = $_POST['lname'] ;
    $email = $_POST['email'] ;
    $pass = $_POST['pass'] ;
    
    if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
          echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
      }else
      {
        if ($Position == 'Student') {
          echo "Student";
          $query = "INSERT INTO student (fname , lname , email , pass ) VALUES ('$fname', '$lname', '$email', '$pass' )";
          if (mysqli_query($conn , $query)) {
            echo "insert to student";
            header('Location: '.slog.'');
          }
        }else{
          echo "Teacher";
          $query = "INSERT INTO teacher (fname , lname , email , pass ) VALUES ('$fname', '$lname', '$email', '$pass' )";
          if (mysqli_query($conn , $query)) {
            echo "insert to teacher";
            header('Location: '.tlog.'');
          }
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

    <title>Sign Up</title>
  </head>
  <body>
    
    <nav class="navbar-default bg-dark text-white">
      <div class="container">
        <h1>Sign Up</h1>
      </div>
    </nav>
    <br>
    <div class="container">
      <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="fname" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="lname" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="pass" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Choose your Position</label><br>
          <input type="radio" name="Teacher" value="Teacher">
          <label for="Teacher">Teacher</label><br>
          <input type="radio" name="Student" value="Student">
          <label for="Student">Student</label><br>
        </div>
      
        <div class="form-group">
          <input type="submit" name="Submit" class="btn btn-dark form-control-file">
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>