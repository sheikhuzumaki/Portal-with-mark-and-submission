<?php  

  session_start();

  error_reporting(0);

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $class = $_SESSION['class'];
  $fname =  $_SESSION['fname'];
  $lname =   $_SESSION['lname'];
  $email =   $_SESSION['email'];
  $assign =  $_SESSION['Assignments'];

  $query = "SELECT * FROM results WHERE fname = '$fname' && lname = '$lname' && email = '$email' && class = '$class' && assigname = '$assign' ";
  $result = mysqli_query($conn, $query);
  $output = mysqli_fetch_assoc($result);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Marks</h1>
        <form method="GET" action="studentportal.php">
          <input type="submit" name="back" class="btn btn-primary float-right" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
      <h1>Your Marks :</h1>
      <br>
      <h4><?php echo $output['marks'] ?></h4>
      <br>
      <h1>Comment :</h1>
      <br>
      <h4><?php echo $output['comment'] ?></h4>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>