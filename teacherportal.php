<?php

  session_start();

  error_reporting(0);

  define('contact', 'https://localhost/Portal/contact.php');
  define('msg', 'https://localhost/Portal/tmsg.php');
  define('tportal', 'https://localhost/Portal/teacherportal.php');
  define('upload', 'https://localhost/Portal/upload.php');
  define('request', 'https://localhost/Portal/request.php');

  $conn = mysqli_connect('localhost', 'root', '', 'portal');

  $info = $_SESSION['email'] ;
  $query = "SELECT * FROM teacher WHERE email = '$info'";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_assoc($result);
  $NAME = $output['fname'];
  $teacheremail = $output['email'];
  

  $query2 = "SELECT * FROM class_teacher WHERE teachername = '$NAME' && email = '$teacheremail' ";
  $result2 = mysqli_query($conn , $query2);
  $output2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
  

  

  
  if ($_GET['class']) {
    $CLASS = $_GET['classname'];
    echo $CLASS;
    //echo $CLASS;
    //$_SERVER['ClassName'] = $_GET['classname'];

    if (empty($CLASS)) {
       echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
            $sql = "CREATE TABLE  $CLASS  (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            txt VARCHAR(100) NOT NULL,
            due VARCHAR(100) NOT NULL,
            picsource VARCHAR(500) NOT NULL)";
            $_SESSION['cname'] = $CLASS;
            
          if(mysqli_query($conn, $sql)){
          echo "Table created successfully.";
          } else
          {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          $str = 'chat';
          $chat = $CLASS.$str;
          $sql1 = "CREATE TABLE  $chat  (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            msg VARCHAR(100) NOT NULL)";
          if(mysqli_query($conn, $sql1)){
          echo "Table created successfully.";
          } else
          {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          $cname = $_SESSION['cname'];
          $query2 = "SELECT * FROM class_teacher WHERE classname = '$cname'";
          $data  = mysqli_query($conn , $query2);
          $log = mysqli_num_rows($data);


          if ($log == 1) {
            echo '<script type="text/javascript">alert("Class Already Exist")</script>';
          }else{
            $query = "INSERT INTO class_teacher (classname , teachername , email) VALUES ('$cname' , '$NAME' , '$teacheremail')";
          if (mysqli_query($conn , $query)) {
           header('Location: '.tportal.'');
          }else
          {
            mysqli_errno($conn);
          }
          }
          

    }

  }

  if ($_GET['upload']) {
    $cname = $_GET['classname'];
    $_SESSION['selectedclass'] = $cname;
    header('Location: '.upload.'');
  }

  if ($_GET['request']) {
    $cname = $_GET['classname'];
    $_SESSION['selectedclass'] = $cname;
    header('Location: '.request.'');
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

    <title>Teacher Portal</title>
  </head>
  <body>

    <nav class="navbar bg-dark text-white">
      <div class="container">
        <h1>Welcome Sir <?php echo $NAME; ?> </h1>
        <form method="GET" action="teacherlog.php">
          <input type="submit" name="back" class="btn btn-danger" value="Log Out">
        </form>
      </div>
    </nav>
    <br>
   
    <br>
    
    <div class="container col-md-8">
      <form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>" >
        <div class="form-group">
          <label>Enter Class Name</label>
          <input type="text" name="classname" class="form-control-file">
        </div>
        <div class="form-group">
          <input type="submit" name="class" class="btn btn-dark form-control-file" value="CREATE CLASS">
        </div>
      </form>
    </div>
    <div class="container">
      <h1>Your Classes :</h1>
    </div>
    <div class="container col-md-8">
      <?php foreach($output2 as $data2) : ?>
      <table class="table table-bordered">
        <th>
          <?php echo $data2['classname'];  ?>
          <form method="GET" action="">
          <input type="hidden" name="classname" value="<?php echo $data2['classname'] ; ?>">
          <input type="submit" name="upload" value="Status" class='btn btn-dark float-right'>
          </form>
          <form method="GET" action="">
            <input type="hidden" name="classname" value="<?php echo $data2['classname'] ; ?>">
          <input type="submit" name="request" value="Requests" class='btn btn-success float-right'>
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