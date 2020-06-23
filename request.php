<?php
  
  session_start();

  error_reporting(0);

  define('request', 'https://localhost/Portal/request.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $CLASS_NAME = $_SESSION['selectedclass'];

  $query = "SELECT * FROM request WHERE class = '$CLASS_NAME' ";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_all($result , MYSQLI_ASSOC);

  if ($_GET['accept']) {
    $id = $_GET['id'];
    $query1 = "SELECT * FROM request WHERE id = '$id' ";
    $result1 = mysqli_query($conn , $query1);
    $output1 = mysqli_fetch_assoc($result1 );
    $fname = $output1['fname'];
    $lname = $output1['lname'];
    $email = $output1['email'];
    $pass = $output1['pass'];
    $class = $output1['class'];

    $SQL = "INSERT INTO approval (fname , lname , email , pass , class ) VALUES ('$fname', '$lname', '$email', '$pass' , '$class' )";
    if (mysqli_query($conn , $SQL)) {
      $delete = "DELETE FROM request WHERE id = '$id' ";
      if (mysqli_query($conn, $delete)) {
         header('Location: '.request.'');
      }else{
          echo mysqli_error($conn);
      }
    }else{
      echo mysqli_error($conn);
    }

  }

  if ($_GET['reject']) {
    $id = $_GET['id'];
    echo $id;
    $query = "DELETE FROM request WHERE id = '$id' ";
    if (mysqli_query($conn , $query)) {
        header('Location: '.request.'');
    }else{
      echo mysqli_error($conn);
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

    <title>Requests</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1><?php echo $CLASS_NAME; ?> Request </h1>
        <form method="GET" action="teacherportal.php">
          <input type="submit" name="back" class="btn btn-primary" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container col-md-8" >
      <div class="container col-md-8">
      <?php foreach($output as $data) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data['fname'];  ?>
          <?php echo $data['lname'];  ?>
          <?php echo $data['class'];  ?>
          <form method="GET" action="">
          <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
          <input type="submit" name="accept" value="Accept" class='btn btn-dark float-right'>
          </form>
          <form method="GET" action="">
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
          <input type="submit" name="reject" value="Reject" class='btn btn-success float-right'>
          </form>
        </th>
      </table>
      <?php endforeach ?>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>