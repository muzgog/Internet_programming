<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Sign up</title>
</head>
<body style ="background-color: #53b0e9;">
    <div class= "container-fluid">
	<?php

	
	require_once 'pageFormatSession.php';

    $pageTitle="Sign up";
    $logo="./images/logo.jpg";
    pageHeaderSession($pageTitle,$logo);


	

	?>

<form action="./signUpHandler.php" method="POST" onsubmit="return validate(this)">
    <label for="Username">Username:</label><br>
    <input type="text" id="Username" name="Username" onblur="validateUsername(this)"><br>
    <p id="usernamemsg"></p>
    <label for="pwd">Password:</label><br>
    <input type="text" id="pwd" name="pwd" onblur="validatePassword(this)"><br>
    <p id="passwordmsg"></p>
    <label for="Name">Name:</label><br>
    <input type="text" id="name" name="name" onblur="validateName(this)"><br>
    <p id="namemsg"></p>
    <label for="Email">Email:</label><br>
    <input type="text" id="Email" name="Email" onblur="validateEmail(this)"><br>
    <p id="emailmsg"></p>
    <input type="submit" class="btn btn-primary" value="Login">
  </form>

  <script type="text/javascript" src="./js/validationSignUp.js"></script>

</body>
</html>