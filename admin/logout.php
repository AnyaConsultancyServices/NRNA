<?php
	session_start();
	
	session_destroy();

	$PAGE = "logout";

 	session_write_close(); //Close the session (optional, but recommended)
	
	header("Location: index.php");
?>
