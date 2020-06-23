<?php

  session_start();

  error_reporting(0);

  define('sportal', 'https://localhost/Portal/smsg.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $info = $_SESSION['email'] ;
  $query = "SELECT * FROM student WHERE email = '$info'";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_assoc($result);
  $fname = $output['fname'];
  $lname = $output['lname'];
  $class = $_SESSION['class'];
  $NAME = $fname.$lname;
  $str = "chat";
  $chat = $class.$str;
  $_SESSION['chatclass'] = $chat ;

  if ($_GET['Submit']) {
    
    $msg = $_GET['msg'];
   
    if (empty($msg)){
      echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
        $query = "INSERT INTO $chat (msg , name) VALUES ('$msg', '$NAME')";
    if (mysqli_query($conn , $query)) {
      header('Location: '.sportal.'');
    }else{
      echo mysqli_errno($conn);
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

    <title>Message</title>
  </head>
    <body>

    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Chat</h1>
        <form class="GET" action="studentportal.php">
          <input type="submit" name="back" class="btn btn-primary" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <div class="container">
    <form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>">
      <div class="form-group">
        <h1>Enter Message</h1>
        <textarea rows="5" cols="50" name="msg"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="Submit" class="btn btn-success">
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