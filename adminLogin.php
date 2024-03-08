<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Admin login</title>
</head>
 <body style ="background-color: #53b0e9;">
  <div class= "container-fluid">
    <?php

    require_once 'pageFormatSession.php';

    $pageTitle="ADMIN LOGIN";
    $logo="./images/logo.jpg";
    pageHeaderSession($pageTitle,$logo);
    ?>  

   <form action="./adminLoginHandler.php" method="POST" onsubmit="return validate(this)">
    <label for="userID">Username:</label><br>
    <input type="text" id="userID" name="userID" onblur="validateUsername(this)"><br>
    <p id="usernamemsg"></p>
    <label for="pwd">Password:</label><br>
    <input type="password" id="pwd" name="pwd" onblur="validatePassword(this)"><br><br>
    <p id="passwordmsg"></p>
    <input type="submit" class="btn btn-primary" value="Login">
  </form>

<script type="text/javascript" src="./js/validationUsers.js"></script>
  
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>