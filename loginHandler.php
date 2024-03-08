<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body style = "background-color: #53b0e9;">
    <div class="container-fluid">
    <?php

    require_once 'pageFormatSession.php';

    $pageTitle="LOGIN";
    $logo="./images/logo.jpg";
    pageHeaderSession($pageTitle,$logo);

    require_once 'connection.php';      
     $conn=connect_db();
    
     $userID=$_POST["userID"];
    $pwd=$_POST["pwd"];

     $query = "SELECT * FROM users WHERE userName=\"$userID\" AND password=SHA1(\"$pwd\")";
     $result=$conn->query($query);
     
     if(!$result)
     {
      die("Query error on login!");
     }
     $rows=$result->num_rows;

     if($rows==1)
      {
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $username=$row["name"];
        $sid = $row["userID"];
        $_SESSION['name'] = $sid;
        echo "<h3>welcome back! $username </h3>";
      }
      else
      {
        echo "<h2 class=\"text-danger\">Login Failed! Try again!<h2>";
      }
      $conn->close();
      

    //echo $email. " :".$pwd;
    
    //$result = $conn->query($query);
      //if(!$result)
       //die("fatal error on query!");

   //$rows = $result->num_rows;




    ?>  

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </div>
</body>
</html>