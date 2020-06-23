<?php

  session_start();
  
  error_reporting(0);

  define('mark', 'https://localhost/Portal/mark.php');

  $class = $_SESSION['submittable'];
  $assign = $_SESSION['sname'];
  $CS = $_SESSION['selectedclass'];
  
  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $query = "SELECT * FROM $class WHERE class = '$CS' && assigname = '$assign' ";
  $result = mysqli_query($conn, $query);
  $output = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if ($_GET['Submit']) {
    $id = $_GET['id'];
    $_SESSION['sid'] = $id;
    header('Location: '.mark.'');
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

    <title>Submiited Assigments</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1><?php echo $assign ; ?> </h1>
        <form method="GET" action="upload.php">
          <input type="submit" name="back" class="btn btn-primary float-right" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container col-md-8">
      <?php foreach($output as $data) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data['assigname'] ;  ?>
          <?php echo "/  From: " ;  ?>
          <?php echo $data['fname'];  ?>
          <?php echo $data['lname'];  ?>
          <form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>">
            <a download="<?php echo $data['picsource'];?>" class="btn btn-primary float-right" href="<?php echo $data['picsource'];?>">Download</a>
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
            <input type="submit" name="Submit" class="btn btn-dark float-right" value="Mark">
          </form>
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