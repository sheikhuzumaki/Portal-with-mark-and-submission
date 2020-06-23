<?php

  session_start();

  error_reporting(0);

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $class = $_SESSION['class'];
  $fname =  $_SESSION['fname'];
  $lname =   $_SESSION['lname'];
  $email =   $_SESSION['email'];
  $assign =  $_SESSION['Assignments'];
  $string = 'submit';
  $submit = $class.$string;

  if ($_POST['upload']) {
    $filename = $_FILES["myfile"]["name"];
    $tmpname = $_FILES["myfile"]["tmp_name"];
    $folder = "Submit/".$filename;
    move_uploaded_file($tmpname, $folder);
    $sql = "CREATE TABLE  $submit  (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fname VARCHAR(100) NOT NULL,
            lname VARCHAR(100) NOT NULL,
            email VARCHAR(256) NOT NULL,
            class VARCHAR(256) NOT NULL,
            assigname VARCHAR(256) NOT NULL,
            picsource VARCHAR(500) NOT NULL)";
    if (mysqli_query($conn, $sql)) {
            //echo "TABLE CREATE";
         }
      $query = "SELECT * FROM $submit WHERE fname = '$fname' && lname = '$lname' && email = '$email' && class = '$class' && assigname = '$assign' ";
            $result = mysqli_query($conn , $query);
            $output = mysqli_fetch_assoc($result);
            echo $output['assigname'];
            $log = mysqli_num_rows($result);
            if ($log == 1) {
              echo '<script type="text/javascript">alert("You have already Submitted")</script>';
            }else{
              $query0 = "INSERT INTO $submit (fname , lname , email , class , assigname , picsource ) VALUES ('$fname', '$lname', '$email', '$class', '$assign' , '$folder' )";
              if (mysqli_query($conn, $query0)) {
                  echo '<script type="text/javascript">alert("Uploaded")</script>';
              }else{
                echo mysqli_error($conn);
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

    <title>Submit</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Submit <?php echo $assign ; ?> </h1>
        <form method="GET" action="studentportal.php">
          <input type="submit" name="back" class="btn btn-primary float-right" value="Back">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container col-md-8">
      <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
          <div class="form-group">
          <input type="file" name="myfile" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="upload" class="btn btn-dark form-control-file">
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