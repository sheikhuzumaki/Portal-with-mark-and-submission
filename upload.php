<?php

  session_start();

  error_reporting(0);

  define('tportal', 'https://localhost/Portal/teacherportal.php');
  define('upload', 'https://localhost/Portal/upload.php');
   define('result', 'https://localhost/Portal/result.php');
 

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

    $CS = $_SESSION['selectedclass'];
    $str = 'chat';
    $chat = $CS.$str;
    $_SESSION['chat'] = $chat ;
    
    //echo $CS.$str2 ;
    
     
    

   $query0 = "SELECT * FROM $CS";
   $result0 = mysqli_query($conn , $query0);
   $output0 = mysqli_fetch_all($result0 , MYSQLI_ASSOC);  
     

   $query = "SELECT * FROM $chat";
   $result = mysqli_query($conn , $query);
   $output = mysqli_fetch_all($result , MYSQLI_ASSOC);

   if ($_POST['upload']) {
    $filename = $_FILES["myfile"]["name"];
    $tmpname = $_FILES["myfile"]["tmp_name"];
    $txt = $_POST['description'];
    $due = $_POST['due'];
    $folder = "Assignments/".$filename;
    if (empty($txt) || empty($due)) {
      echo '<script type="text/javascript">alert("Fill All the Blanks")</script>';
    }else{
        move_uploaded_file($tmpname, $folder);
    $cname = $_SERVER['cname'];
    $query = "INSERT INTO $CS (txt , due , picsource ) VALUES ('$txt', '$due', '$folder')";
    if (empty('description') || empty('due')) {
          echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
      if (mysqli_query($conn , $query)) {
     echo '<script type="text/javascript">alert("Uploaded")</script>';
      header('Location: '.upload.'');
    }else{
      echo mysqli_errno($conn);
    }
  }
    }
       
}

if ($_GET['result']) {
  $str2 = 'submit';
  $_SESSION['submittable'] = $CS.$str2;
  $assigname = $_GET['assigname'];
  $_SESSION['sname'] = $assigname;
  $string = 'submit';
  $submit = $CS.$string;
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
  header('Location: '.result.'');

}

if ($_GET['msg']) {
   header('Location: '.upload.'');
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

    <title>Class</title>
  </head>
  <body>
    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1><?php echo $CS ; ?></h1>
        <form method="GET" action="tmsg.php">
          <input type="submit" name="msg" class="btn btn-success" value="Write Message">
        </form>
        <form method="GET" action="teacherportal.php">
          <input type="submit" name="Back" class="btn btn-success" value="Home">
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
   
    <div class="container col-md-8">
      <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
          <div class="form-group">
            <label>Enter Description</label>
          <input type="text" name="description" class="form-control-file" >
          </div>
           <div class="form-group">
            <label>Enter Due Date</label>
          <input type="text" name="due" class="form-control-file" >
          </div>
          <div class="form-group">
          <input type="file" name="myfile" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="upload" class="btn btn-dark form-control-file">
        </div>
      </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
      <h1>Assignments !</h1>
    </div>
    <div class="container col-md-8">
      <?php foreach($output0 as $data0) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data0['txt'];  ?>
          <form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="name" class="btn btn-primary float-right" value="Due Date : <?php echo $data0['due']; ?>">
          <input type="hidden" name="assigname" class="btn btn-dark float-right" value="<?php echo $data0['txt']; ?>">
          <input type="submit" name="result" class="btn btn-dark float-right" value="Status">
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