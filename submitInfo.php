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
	$contactID=sanitizeString($_POST['contactID']);
  $contactName=sanitizeString($_POST['name']);
  $emailAddress=sanitizeString($_POST['email']);
  $addressLine1=sanitizeString($_POST['al1']);
  $addressLine2=sanitizeString($_POST['al2']);
  $addressLine3=sanitizeString($_POST['al3']);
  $city=sanitizeString($_POST['city']);
  $state=sanitizeString($_POST['state']);
  $zip=sanitizeString($_POST['zip']);
  $country=sanitizeString($_POST['country']);



	$_POST=array();

	if ($contactID=="")
	{
		$query = "INSERT INTO info (userID, contactName, emailAddress, addressLine1, addressLine2, addressLine3, city, state, zip, country) VALUES (\"$uid\",\"$contactName\",\"$emailAddress\",\"$addressLine1\",\"$addressLine2\",\"$addressLine3\",\"$city\",\"$state\",\"$zip\",\"$country\")";
     $conn->query($query);
	}
	else
	{
	 $query = "UPDATE info SET contactName=\"$contactName\", emailAddress=\"$emailAddress\", addressLine1=\"$addressLine1\", addressLine2=\"$addressLine2\", addressLine3=\"$addressLine3\", city=\"$city\", state=\"$state\", zip=\"$zip\", country=\"$country\" WHERE contactID=\"$contactID\"";
     $conn->query($query);
	}
      

	$conn->close();

	$out="Contact Information Updated";

	echo "$out";
?>
	<script type="text/javascript" src=./js/cart.js></script>
</body>

</html>