<?php

	//session_start();
	$LOGINID=0;
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)
	{
		$LOGINID = $_SESSION['user_id'];
	}

	if($LOGINID == 0)
	{
		header('location: login.php');
	}
?>