<?php

  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $CS = $_SESSION['selectedclass'];
  $assign = $_SESSION['sname'];
  $class = $_SESSION['submittable'];
  $id = $_SESSION['sid'];
  $string = 'marks';
  $table = $CS.$string;
  echo $table;
  
  $query = "SELECT * FROM $class WHERE id = '$id' ";
  $result = mysqli_query($conn, $query);
  $output = mysqli_fetch_assoc($result);
  $fname = $output['fname'];
  $lname = $output['lname'];
  $email = $output['email'];
  
  if ($_GET['Submit']) {
    $marks = $_GET['marks'];
    $comment = $_GET['comment'];
    
    if (empty($marks) || empty($comment)) {
      echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
      $query0 = "SELECT * FROM results WHERE fname = '$fname' && lname = '$lname' && email = '$email' && class = '$CS' && assigname = '$assign' ";
    $result0 = mysqli_query($conn , $query0);
    $log = mysqli_num_rows($result0);
    if ($log == 1) {
      echo '<script type="text/javascript">alert("You have Already Marked")</script>';
    }else{
      $query1 = "INSERT INTO results (fname , lname , email , class , assigname , marks , comment ) VALUES ('$fname', '$lname', '$email', '$CS' ,    '$assign' , '$marks' , '$comment' )";
      if (mysqli_query($conn , $query1)) {
        echo '<script type="text/javascript">alert("Marked")</script>';
      }else{
        echo mysqli_error($conn);
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

    <title>Mark </title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Mark  <?php echo $assign ; ?></h1>
        <form method="GET" action="result.php">
          <input type="submit" name="back" class="btn btn-primary float-right" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container col-md-8">
      <form>
        <div class="form-group">
          <label>Enter Marks</label>
          <input type="text" name="marks" class="form-control-file">
        </div>
        <div class="form-group">
          <label>Comment</label>
          <input type="text" name="comment" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="Submit" class="form-control-file btn btn-dark">
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