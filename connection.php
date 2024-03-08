<?php

function connect_db()
{
	$hn = "localhost";
	$un = "projectUser";
	$pwd = "projectAdmin@1234";
	$db = "projecttwo";

	//for production server
	//$hn = "";
	//$un = "";
	//$pwd = "";
	//$db = "";

	$conn = new mysqli($hn, $un, $pwd, $db);
	if($conn->connect_error)
		die("Fatal error on connecting DB");

	return $conn;
}

?>