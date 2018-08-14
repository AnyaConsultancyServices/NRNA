<?php

	//session_start();
	$LOGINID=0;
	if(isset($_SESSION['adminid']) && $_SESSION['adminid'] > 0)
	{
		$LOGINID = $_SESSION['adminid'];
	}

	if($LOGINID == 0)
	{
		header('location: login.php');
	}
?>