<?php

  session_start();

  error_reporting(0);

  define('contact', 'https://localhost/Portal/contact.php');
  define('msg', 'https://localhost/Portal/smsg.php');
  define('slog', 'https://localhost/Portal/studentlog.php');
  define('sportal', 'https://localhost/Portal/studentportal.php');
  define('submit', 'https://localhost/Portal/submit.php');
  define('cmarks', 'https://localhost/Portal/checkmarks.php');


  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $info = $_SESSION['email'] ;
  $query = "SELECT * FROM Student WHERE email = '$info'";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_assoc($result);
  $fname = $output['fname'];
  $lname = $output['lname'];
  $email = $output['email'];
  $class = $_SESSION['class'];

  $str = "chat";
  $chat = $class.$str;
  $_SESSION['chatclass'] = $chat ;
  

  $query1 = "SELECT * FROM $chat";
  $result1 = mysqli_query($conn , $query1);
  $output = mysqli_fetch_all($result1 , MYSQLI_ASSOC);
  
  $query2 = "SELECT * FROM $class";
  $result2 = mysqli_query($conn , $query2);
  $output2 = mysqli_fetch_all($result2 , MYSQLI_ASSOC);
 

  if ($_POST['Submit']) {
     $Assignments = $_POST['AssignmentName'] ;
     $_SESSION['fname']= $fname;
     $_SESSION['lname']= $lname;
     $_SESSION['email']= $email;
     $_SESSION['Assignments']= $Assignments;
     header('Location: '.submit.'');
  }

  if ($_POST['result']) {
     $Assignments = $_POST['AssignmentName'] ;
     $_SESSION['fname']= $fname;
     $_SESSION['lname']= $lname;
     $_SESSION['email']= $email;
     $_SESSION['Assignments']= $Assignments;
     header('Location: '.cmarks.'');
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

    <title>Student Portal</title>
  </head>
  <body>

    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Welcome <?php echo $fname . $lname; ?> !</h1>
        <form method="GET" action="smsg.php">
          <input type="submit" name="msg" class="btn btn-success" value="Write Message">
        </form>
        <form method="GET" action="studentlog.php">
          <input type="submit" name="back" class="btn btn-danger" value="Log Out">
        </form>
      </div>
    </nav>
    <br>
    <div class="container">
      <h1>Class : <?php echo $class; ?> </h1>
    </div>
    <div class="container">
      <h1>Assignments</h1>
    </div>
    <div class="container col-md-8">
      <?php foreach($output2 as $data) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data['txt'];  ?>
          <form enctype="multipart/form-data" action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['picsource'] ?>">
            <input type="hidden" name="filename" value="<?php echo $data['name'] ?>">
            <a download="<?php echo $data['picsource'];?>" class="btn btn-primary float-right" href="<?php echo $data['picsource'];?>">Download</a>
            <input type="hidden" name="AssignmentName" value="<?php echo $data['txt'] ?>">
            <input type="submit" name="result" class="btn btn-success float-right" value="Check Result">
            <input type="submit" name="Submit" class="btn btn-dark float-right" value="Deliver">
          </form>
        </th>
      </table>
      <?php endforeach ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
      <h1>Chat !</h1>
    </div>
    <div class="container col-md-8">
      <?php foreach($output as $data) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data['msg'];  ?>
          <input type="text" name="name" class="btn btn-primary float-right" value="From : <?php echo $data['name']; ?>">
        </th>
      </table>
      <?php endforeach ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>