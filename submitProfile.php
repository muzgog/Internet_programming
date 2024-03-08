<!--Timur Maistrenko. Handles menu items search AJAX requests--->
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" dir="ltr"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AJAX Handler</title>
</head>
<body>
	<?php
	require_once "connection.php";
	require_once "security.php";
	$flag=true;
	$out="";
	$conn=connect_db();
	$name=sanitizeString($_POST['name']);
	$uid=sanitizeString($_POST['uid']);
	$username=sanitizeString($_POST['username']);
	$email=sanitizeString($_POST['email']);

	//$name=sanitizeString($_POST['name']);
	//$uid=sanitizeString($_POST['uid']);
	//$username=sanitizeString($_POST['username']);
	//$email=sanitizeString($_POST['email']);
	$_POST=array();

	$query="SELECT userID FROM users WHERE userName=\"$username\";";
	$result=$conn->query($query);

	for ($i=0;$i<$result->num_rows;$i++)
	{
		$row=$result->fetch_array(MYSQLI_ASSOC);
		if ($uid!=$row['userID'])
		{

			$flag=false;
			$out=$out."<span style=\"color: #ff0000\">Username already exists</span><br>";
		}
	}

	$query="SELECT userID FROM users WHERE email=\"$email\";";
	$result=$conn->query($query);

	for ($i=0;$i<$result->num_rows;$i++)
	{
		$row=$result->fetch_array(MYSQLI_ASSOC);
		if ($uid!=$row['userID'])
		{
			$flag=false;
			$out=$out."<span style=\"color: #ff0000\">Email already exists</span><br>";
		}
	}

	if ($flag)
	{
		$query="UPDATE users SET userName=\"$username\",email=\"$email\",name=\"$name\" WHERE userID=\"$uid\";";
		$conn->query($query);
		$out="Changes Saved";
	}
	$conn->close();



	echo "$out";
?>
	<script type="text/javascript" src=./js/cart.js></script>
</body>

</html>