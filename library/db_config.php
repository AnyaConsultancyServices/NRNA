<?php 

	if(!isset($_SESSION))
	{
		@session_start();
	}

	$mysql_ip = 'localhost';
	$mysql_user = 'nrnacxch_nrnausr';
	$mysql_pass = '?3P70&flpo(e';
	$mysql_db = 'nrnacxch_nrnadb_live';

	$pdodb = new PDO("mysql:host=$mysql_ip;dbname=$mysql_db", $mysql_user, $mysql_pass);

	date_default_timezone_set('Europe/London');
	//date_default_timezone_set('asia/kolkata');

	define('BASE_PATH', 'http://nrna.co.uk');

	if(isset($ajaxcall)){
		include('../helper.php');
	} else { 
		include('helper.php'); 
	}

?>