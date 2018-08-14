<?php
include ("db_config.php");

include ("loginfunctions.php");

include ("emails.php");

if (!empty($_POST["checkuseremail"]))
{
	$email = trim($_POST["checkuseremail"]);
	$stmt = $pdodb->prepare("SELECT member_id FROM nrna_members WHERE email=:email AND email !='' ");
	$stmt->bindParam("email", $email, PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();
	if ($count > 0)
	{
		echo "<span class='status-not-available' style='color:#FF0000;'> Email Already Used.</span>";
	}
	else
	{
		echo "<span class='status-available' style='color:#27AE60;'> Email Available.</span>";
	}
}

/*** Register New member ***/
if (isset($_POST["action"]) && $_POST["action"] == 'register')
{
	$fullname = $_POST["fullname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$phone = $_POST["phone"];
	$dateofbirth = $_POST["dob"];
	$passportnumber = $_POST["passport"];
	$ukaddress = $_POST["ukaddress"];
	$nepaladdress = $_POST["nepaladdress"];
	$memberstatus = "pending";

	// User availability Check
	$check1 = userAvailable($pdodb, $_POST["email"]);
	if ($check1 == 0){
		// Adding user details
		$stmt = $pdodb->prepare("INSERT INTO nrna_members(`member_name`, `email`, `password`, `phone`, `dob`, `passport_num`, `uk_address`, `nepal_address`, `mem_status`, `member_since`) VALUES (?,?,?,?,?,?,?,?,?,NOW())");
		$data = array(
			$fullname,
			$email,
			$password,
			$phone,
			$dateofbirth,
			$passportnumber,
			$ukaddress,
			$nepaladdress,
			$memberstatus
		);
		$result = $stmt->execute($data);
		$lid = $pdodb->lastInsertId();
		$_SESSION['last_id'] = $lid;
		if ($result)
		{

			// Sending Confirmation Email
			$params = array(
				'user_id' => $lid,
				'email' => $_POST["email"],
				'name' => $_POST["fullname"],
				'password' => $_POST["password"]
			);
			signupConfirm($params);

			 echo $succ_msg = $helper_msg['signup_succ'];

		}
		else
		{  echo $err_msg = $helper_msg['signup_err']; 
		}
	}
	else
	{  echo $err_msg = $helper_msg['user_exist']; 
	}
}


/*** Upload Passport & Address proof ***/
if (isset($_POST["action"]) && $_POST["action"] == 'uploadPassport')
{
	$member_id = $_SESSION['last_id'];
	$data = array();
	if (isset($_GET['files']))
	{
		$error = false;
		$files = array();
		$minWidth = 100;
		$minHeight = 100;
		$prof_path = "../uploads/memberimages/";
		if (!is_dir($prof_path))
		{
			mkdir($prof_path, 0777);
		}

		$uploaddir = $prof_path . $member_id . '/';
		if (!is_dir($uploaddir))
		{
			mkdir($uploaddir, 0777);
		}

		$image_info = getimagesize($_FILES["passportimg"]["tmp_name"]);
		$imgwidth = $image_info[0];
		$imgheight = $image_info[1];
		if (($imgwidth <= $minWidth) || ($imgheight <= $minHeight))
		{
			$data = "Please Choose Image Size greater than  100px";
		}
		else
		if ($_FILES['passportimg']['type'] != 'image/jpeg' && $_FILES['passportimg']['type'] != 'image/jpg' && $_FILES['passportimg']['type'] != 'image/gif' && $_FILES['passportimg']['type'] != 'image/png')
		{
			$data = "Please upload only Image file";
		}
		else
		{
			foreach($_FILES as $file)
			{
				$tmp_name = str_replace(" ", "", $file['tmp_name']);
				$name = str_replace(" ", "", basename($file['name']));
				$uploaddirpath = 'uploads/memberimages/' . $member_id . '/' . $name;
				if (move_uploaded_file($tmp_name, $uploaddir . $name))
				{
					$files[] = $uploaddir . $name;
				}
				else
				{
					$error = true;
				}
			}

			$data = ($error) ? array(
				'error' => 'There was an error uploading your files'
			) : array(
				'files' => $files
			);
			$updQry = $pdodb->prepare("UPDATE nrna_members SET passport_img= ? WHERE member_id = ?");
			$data = array(
				$uploaddirpath,
				$member_id
			);
			$upd = $updQry->execute($data);
		}
	}
	else
	{
		$data = array(
			'success' => 'Form was submitted',
			'formData' => $_POST
		);
	}

	echo json_encode($data);
}


if (isset($_POST['mem_relation']))
{
	$relation = $_POST["mem_relation"];
	$name = $_POST["mem_name"];
	$email = $_POST["mem_email"];
	$dob = $_POST["mem_dob"];
	$passport = $_POST["mem_passport"];
	$createdby = $_SESSION['last_id'];
	$memberstatus = "pending";
	for ($count = 0; $count < count($relation); $count++)
	{
		$relation_clean = $relation[$count];
		$name_clean = $name[$count];
		$email_clean = $email[$count];
		$dob_clean = $dob[$count];
		$passport_clean = $passport[$count];
		$password = randomPassword();
		if ($relation_clean != '' && $name_clean != '')
		{
			$check2 = userAvailable($pdodb, $email_clean);
			if ($check2 == 0)
			{
				$pdodb->query('INSERT INTO nrna_members(`member_name`, `email`, `password`, `dob`, `passport_num`, `member_relation`, `mem_status`, `member_since`, `created_by`) 
							VALUES("' . $name_clean . '", "' . $email_clean . '", "' . $password . '", "' . $dob_clean . '", "' . $passport_clean . '", "' . $relation_clean . '", "' . $memberstatus . '", now(), "' . $createdby . '")');

				$lid = $pdodb->lastInsertId();
				// Sending Confirmation Email
				$params = array(
					'user_id' => $lid,
					'email' => $email_clean,
					'name' => $name_clean,
					'password' => $password
				);

				 signupConfirm($params);

			}
		}
	}
}


// Password reset form. Landing page
if(isset($_GET["tk"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "pwd-reset"){

	$email = $_GET["em"]; $tk = $_GET["tk"];

	$rstQry = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND password = ? AND password !=''"); 
	$data = array($email, $tk);
	$rstQry->execute($data);
	$count = $rstQry->rowCount();

	if($count == 1){ 
		$dt = $rstQry->fetch(PDO::FETCH_OBJ);
		$uemail = $dt->email;
	}else{
		$err_msg = $helper_msg['pwd_reset_invalid']; $uemail = '';
	}
}

//Password recovery form
if(isset($_POST["pwd_recovery"], $_POST["newpass"]) && $_POST["newpass"] != ""){ 

	if($_POST["newpass"] == $_POST["confpass"]){

		$email = $_POST["em"]; $tk = $_POST["tk"];

		$stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND password = ? AND password !=''"); 
		$data = array(md5($email), $tk);
		$stmt->execute($data);
		$count = $stmt->rowCount();

		if($count == 1){

			$password = $_POST["newpass"];

			$updQry1 = $pdodb->prepare("UPDATE nrna_members SET password = ? WHERE MD5(email) = ? ");

	        $data = array($password, md5($email));
	        $upd1 = $updQry1->execute($data);

	        if($upd1){ 

	        	passwordRecovery_acknowledge($email);

	        	$succ_msg = $helper_msg['pwdreset_succ']; 
	        	$uemail = '';

	        }else{ $err_msg = $helper_msg['userconfirm_err2']; }

		}else{ $err_msg = $helper_msg['pwd_reset_invalid']; }

	}else{ $err_msg = $helper_msg['password_mismatch']; }
}


// Conforming the email address and account activation
if(isset($_GET["u"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "user-confirm"){

	//User availability Check
    $email = $_GET["em"]; $uid = $_GET["u"];

	$stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending'"); 
	$data = array($email, $uid);
	$stmt->execute($data);
	$count = $stmt->rowCount();

	if($count == 1){

		$updQry = $pdodb->prepare("UPDATE nrna_members SET mem_status='active' WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending' "); 
        $data = array($email, $uid);

        $upd = $updQry->execute($data);

        if($upd){ $succ_msg = $helper_msg['userconfirm_succ']; }
        else{ $err_msg = $helper_msg['userconfirm_err2']; }

	}else{ $err_msg = $helper_msg['userconfirm_err1'];  }
}


	if(isset($_POST["action"]) && $_POST["action"] == 'updatepass') {

		$userid = $_POST["userid"];
		$oldpassword = $_POST["oldpassword"];
		$newpassword = $_POST["newpassword"];

		$stmt = $pdodb->prepare("SELECT password FROM nrna_members WHERE password = ? AND member_id = ?"); 
		$data = array($oldpassword, $userid);
		$stmt->execute($data);
		$count = $stmt->rowCount();
	
		if($count > 0){
	
			$updQry = $pdodb->prepare("UPDATE nrna_members SET password = ? WHERE member_id = ?"); 
			$data = array($newpassword, $userid);
			$upd = $updQry->execute($data);
	
		}

	}

?>