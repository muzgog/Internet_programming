<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign up handler</title>
</head>
<body>
    <?php 

    require_once 'pageFormatSession.php';

    $pageTitle="Sign up handler";
    $logo="./images/logo.jpg";
    pageHeaderSession($pageTitle,$logo);

    $userID=$_POST["Username"];
    $password=$_POST["pwd"];
    $name=$_POST["name"];
    $email=$_POST["Email"];
   
    

    require_once 'connection.php';      
     $conn=connect_db();
     $query= "INSERT INTO users(userName, password, name, email) VALUES (\"$userID\",SHA1(\"$password\"),\"$name\",\"$email\")";
     $result=$conn->query($query);
     
     if(!$result)
     {
      die("Query error on login!");
     }
     else
     {
        echo "You are all signed up";
     }


     
    ?>


</body>
</html>