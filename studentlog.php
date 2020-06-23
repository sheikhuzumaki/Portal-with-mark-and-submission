<?php

  session_start();

  error_reporting(0);

  define('sportal', 'https://localhost/Portal/studentportal.php');
  define('slog', 'https://localhost/Portal/studentlog.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $query = "SELECT * FROM class_teacher";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_all($result , MYSQLI_ASSOC);

  //var_dump($output);

  if ($_GET['Submit']) {
    $email = $_GET['email'];
    $pass = $_GET['password'];
    $class = $_GET['option'];
    $_SESSION['class'] = $class;
    $_SESSION['email'] = $email;
    //echo $class;

    $query0 = "SELECT * FROM student WHERE email = '$email' && pass = '$pass' ";
    $result0 = mysqli_query($conn , $query0);
    $log = mysqli_num_rows($result0);

    if (empty($email) || empty($pass)) {
        echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
      if ($log == 1) {

      $QR = "SELECT * FROM approval WHERE email = '$email' && pass = '$pass' && class = '$class' ";
      $RS = mysqli_query($conn , $QR);
      $APPROVAL = mysqli_num_rows($RS);
      if ($APPROVAL == 1) {
        header('Location: '.sportal.'');
      }else{
        $SQL = "SELECT * FROM request WHERE email = '$email' && pass = '$pass' && class = '$class' ";
       $ANS = mysqli_query($conn , $SQL);
       $GRAB = mysqli_num_rows($ANS);
       if ($GRAB == 1) {
         echo '<script type="text/javascript">alert("You Have Already send a request")</script>';
       }else{
        echo "NOT Exist";
         $output0 = mysqli_fetch_assoc($result0);
        $fname = $output0['fname'];
        $lname = $output0['lname'];
       echo $fname;
       $query2 = "INSERT INTO request (fname , lname , email , pass , class ) VALUES ('$fname', '$lname', '$email', '$pass' , '$class' )";
          if (mysqli_query($conn , $query2)) {
            echo '<script type="text/javascript">alert("Your Request is Sent")</script>';
            //echo "Write";
          }
      }
       }
      }

      else{
        echo '<script type="text/javascript">alert("Unsuccessful Log In")</script>';
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

    <title>Student Log In</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Student Log In</h1>
        <form method="GET" action="register.php">
          <input type="submit" name="back" class="btn btn-danger" value="Sign Up">
        </form>
      </div>
    </nav>
    <br>
    <div class="container">
      <form method="GET" accept="#">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control-file">
        </div>
        <div class="form-group">
        <select name="option">
        <option>Choose Class</option>
        <?php foreach($output as $class) : ?>
        <option  value="<?php echo $class['classname'] ?>"><?php echo $class['classname'] ?></option>
        <?php endforeach  ?>
       </select> 
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