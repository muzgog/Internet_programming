<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Admin login handler</title>
</head>
<body>
	<?php

    require_once 'pageFormatSession.php';

    $pageTitle="ADMIN LOGIN";
    $logo="./images/logo.jpg";
    pageHeaderSession($pageTitle,$logo);

 

    $userID=$_POST["userID"];
    $password=$_POST["pwd"];

    require_once 'connection.php';      
     $conn=connect_db();

     //echo $email. " :".$pwd;
     $query = "SELECT * FROM admin WHERE userName=\"$userID\" AND password=SHA1(\"$password\")";
     $result=$conn->query($query);
     
     if(!$result)
     {
      die("Query error on login!");
     }

     $rows=$result->num_rows;
     //echo $rows;

     if($rows==1)
      {

        $row=$result->fetch_array(MYSQLI_ASSOC);
        $username=$row["userName"];
        $_SESSION['name']=$username;
        $_SESSION['admin']=$username;


        echo "<h3>Welcome! $username, you have logined as admin </h3>";
      }
      else
      {
        echo "<h2 class=\"text-danger\">Login Failed! Try again!<h2>";
      }
	?>

</body>
</html>