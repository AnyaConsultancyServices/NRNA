<?php
	function checkLogin()
	{
		if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false)
		{
			header('Location: login.php');
			exit;
		}
	}
	
	function redirect($url)
	{
		if (!headers_sent()) header('Location: ' . $url);
		else
		{
			echo '<script type="text/javascript">';
			echo 'window.location.href="' . $url . '";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
			echo '</noscript>';
		}
	}

	function userAvailable($db, $email){

		$email = trim($email);
		$stmt = $db->prepare("SELECT member_id FROM nrna_members WHERE email=:email AND email !='' "); 
		$stmt->bindParam("email", $email, PDO::PARAM_STR); 
		$stmt->execute();
		$count=$stmt->rowCount();
		return $count;
	}	

	function tokenGeneration(){ 
		$token = md5(uniqid(rand(), true));
		return $token;
	}


	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 5; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}	

?>