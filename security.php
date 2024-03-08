<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Security</title>
</head>
<body>

	<?php

	//this is from the textbook for security

	function sanitizeString($s)
	{
		//if(get_magic_quotes_gpc())
			$s = stripslashes($s);
		$s = strip_tags($s);
		$s = htmlentities($s);
		return $s;
	}

	?>

</body>
</html>