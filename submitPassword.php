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
	$flag=false;
	$out="";
	$conn=connect_db();
	$uid=sanitizeString($_POST['uid']);
	$currentPwd=sanitizeString($_POST['currentPwd']);
	$newPwd=sanitizeString($_POST['newPwd']);

	$_POST=array();

	 $query = "SELECT * FROM users WHERE userID=\"$uid\" AND password=SHA1(\"$currentPwd\")";
     $result=$conn->query($query);
     
     if(!$result)
     {
      die("Query error!");
     }
     $rows=$result->num_rows;


     if($rows==1)
      {
        $out=$out."Good";
        $flag=true;
      }
      else if ($rows==0)
      {
        $out=$out."<span style=\"color: #ff0000\">Incorrect Current Password</span><br>";
      }
      else 
      	{
        $out=$out."<span style=\"color: #ff0000\">Error</span><br>";
      }
      



	if ($flag)
	{
		$query="UPDATE users SET password=SHA1(\"$newPwd\") WHERE userID=\"$uid\";";
		$conn->query($query);
		$out="Password Updated";
	}
	$conn->close();



	echo "$out";
?>
	<script type="text/javascript" src=./js/cart.js></script>
</body>

</html>