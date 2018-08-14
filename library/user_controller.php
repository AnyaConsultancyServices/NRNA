<?php

$valid_formats = array("jpg","jpeg","png","7z","pdf","xlsx","xls","docx","doc","txt");

include ("db_config.php");

include ("loginfunctions.php");

include ("emails.php");

// PayPal Url - Sandbox
/*
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$busId = 'treasury.nrnauk-facilitator@gmail.com';
*/

// PayPal Url - Live


$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
$busId = 'treasury.nrnauk@gmail.com';

$emailArr = array();

if (!empty($_POST["checkuseremail"]))
{
	$email = trim($_POST["checkuseremail"]);
	$stmt = $pdodb->prepare("SELECT member_id, txn_id FROM nrna_members WHERE email=:email AND email !='' ");
	$stmt->bindParam("email", $email, PDO::PARAM_STR);
	$stmt->execute();
        
	$count = $stmt->rowCount();
	if ($count > 0)
	{
                $emailcheck = $stmt->fetch(PDO::FETCH_OBJ);
$created_by = $emailcheck->member_id;
if($emailcheck->txn_id!=''):
echo "<span class='status-msg status-available' style='color:#cc5965'>Email Already Used</span>";
?>
<?php 
else:

$delete = $pdodb->prepare("DELETE FROM nrna_members  WHERE created_by=:created_by");
$delete->bindParam("created_by", $created_by, PDO::PARAM_STR);
$delete->execute();

$stmt = $pdodb->prepare("DELETE FROM nrna_members  WHERE email=:email");
$stmt->bindParam("email", $email, PDO::PARAM_STR);
$stmt->execute(); 

if($stmt){
//echo "<span class='status-msg status-available ' style='color:#27AE60;'> Email Available.</span>";
}
endif;
	}
	else
	{
		//echo "<span class='status-msg  status-available' style='color:#27AE60;'> Email Available.</span>";
	}
}

/*** Register New member ***/

if (isset($_POST["action"]) && $_POST["action"] == 'register')
{
	$fullname = $_POST["fullname"];
        $lname = $_POST["member_lastname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$phone = $_POST["phone"];
	$dateofbirth = $_POST["dob"];
	$passportnumber = $_POST["passport"];
	$ukaddress = $_POST["ukaddress"];
	$nepaladdress = $_POST["nepaladdress"];
	$memberstatus = "pending";
	$profession = $_POST["profession"];
	$liketovote = $_POST["liketovote"];
$prof_others = $_POST["prof_others"];
$income = $_POST["income"];
$income_others = $_POST["income_others"];
  if($liketovote == 'Yes'):
    $mainamt = 10;
  else:
    $mainamt = 5;
  endif;
  

	// User availability Check

	$check1 = userAvailable($pdodb, $_POST["email"]);
	if ($check1 == 0)
	{

		// Adding user details

		$stmt = $pdodb->prepare("INSERT INTO nrna_members(`member_name`, `member_lastname`, `email`, `password`, `phone`, `dob`, `passport_num`, `uk_address`, `nepal_address`, `mem_status`, `member_since`, `profession`, `like_to_vote`, `profession_others`,`income`,`income_others`) VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?,?,?)");
		$data = array(
			$fullname,
                        $lname,
			$email,
			$password,
			$phone,
			$dateofbirth,
			$passportnumber,
			$ukaddress,
			$nepaladdress,
			$memberstatus,
                        $profession,
                        $liketovote,
                        $prof_others,
                        $income,
                        $income_others

		);
		$result = $stmt->execute($data);
		$lid = $pdodb->lastInsertId();
		$_SESSION['last_id'] = $lid;
		$_SESSION['reg_fullname'] = $fullname;
		$_SESSION['reg_email'] = $email;
                $_SESSION['main_vote'] = $mainamt;
		if ($result)
		{

			// Sending Confirmation Email

			$params = array(
				'user_id' => $lid,
				'email' => $_POST["email"],
				'name' => $_POST["fullname"],
				'password' => $_POST["password"]
			);

			//signupConfirm($params);

			array_push($emailArr, $params);
			$_SESSION['emailArr'] = $emailArr;

			echo $succ_msg = $helper_msg['signup_succ'];
		}
		else
		{
			echo $err_msg = $helper_msg['signup_err'];
		}
	}
	else
	{
		echo $err_msg = $helper_msg['user_exist'];
	}
}





/*** Upload Profile pick  ***/

if (isset($_POST["action"]) && $_POST["action"] == 'uploadProfile')
{
	$member_id = $_SESSION['user_id'];
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

		$image_info = getimagesize($_FILES["profileimg"]["tmp_name"]);
		$imgwidth = $image_info[0];
		$imgheight = $image_info[1];
		if (($imgwidth <= $minWidth) || ($imgheight <= $minHeight))
		{
			$data = "Please Choose Image Size greater than  100px";
		}
		else
		if ($_FILES['profileimg']['type'] != 'image/jpeg' && $_FILES['profileimg']['type'] != 'image/jpg' && $_FILES['profileimg']['type'] != 'image/gif' && $_FILES['profileimg']['type'] != 'image/png')
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
			$updQry = $pdodb->prepare("UPDATE nrna_members SET mem_image= ? WHERE member_id = ?");
			$data = array(
				$uploaddirpath,
				$member_id
			);
			$upd = $updQry->execute($data);
$_SESSION['mem_img'] = $uploaddirpath;
                        $data = array(
				$uploaddirpath,
				$member_id,
                                'Success'
			);
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


/*** Upload Profile pick End ***/




/*** Upload Signature pick  ***/

if (isset($_POST["action"]) && $_POST["action"] == 'uploadSignature')
{
	$member_id = $_SESSION['user_id'];
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

		$image_info = getimagesize($_FILES["signatureimg"]["tmp_name"]);
		$imgwidth = $image_info[0];
		$imgheight = $image_info[1];
		if (($imgwidth <= $minWidth) || ($imgheight <= $minHeight))
		{
			$data = "Please Choose Image Size greater than  100px";
		}
		else
		if ($_FILES['signatureimg']['type'] != 'image/jpeg' && $_FILES['signatureimg']['type'] != 'image/jpg' && $_FILES['signatureimg']['type'] != 'image/gif' && $_FILES['signatureimg']['type'] != 'image/png')
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
			$updQry = $pdodb->prepare("UPDATE nrna_members SET signature_image= ? WHERE member_id = ?");
			$data = array(
				$uploaddirpath,
				$member_id
			);
			$upd = $updQry->execute($data);
$_SESSION['signature_img'] = $uploaddirpath;
                        $data = array(
				$uploaddirpath,
				$member_id,
                                'Success'
			);
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


/*** Upload Signature pick End ***/




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









/*** Upload Passport Last & Address proof ***/

if (isset($_POST["action"]) && $_POST["action"] == 'uploadpassportlast')
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

		$image_info = getimagesize($_FILES["passportlast"]["tmp_name"]);
		$imgwidth = $image_info[0];
		$imgheight = $image_info[1];
		if (($imgwidth <= $minWidth) || ($imgheight <= $minHeight))
		{
			$data = "Please Choose Image Size greater than  100px";
		}
		else
		if ($_FILES['passportlast']['type'] != 'image/jpeg' && $_FILES['passportlast']['type'] != 'image/jpg' && $_FILES['passportlast']['type'] != 'image/gif' && $_FILES['passportlast']['type'] != 'image/png')
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
			$updQry = $pdodb->prepare("UPDATE nrna_members SET passport_last_page= ? WHERE member_id = ?");
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
/*** Upload Proof Image  ***/

if (isset($_POST["action"]) && $_POST["action"] == 'uploadProofs')
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

		$image_info = getimagesize($_FILES["addressproof"]["tmp_name"]);
		$imgwidth = $image_info[0];
		$imgheight = $image_info[1];
		if (($imgwidth <= $minWidth) || ($imgheight <= $minHeight))
		{
			$data = "Please Choose Image Size greater than  100px";
		}
		else
		if ($_FILES['addressproof']['type'] != 'image/jpeg' && $_FILES['addressproof']['type'] != 'image/jpg' && $_FILES['addressproof']['type'] != 'image/gif' && $_FILES['addressproof']['type'] != 'image/png')
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
			$updQry = $pdodb->prepare("UPDATE nrna_members SET address_proof= ? WHERE member_id = ?");
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


/*** Upload Proof Image End ***/





if (isset($_POST['mem_relation']))
{
	$relation = $_POST["mem_relation"];
	$name = $_POST["mem_name"];
	$email = $_POST["mem_email"];
	$mem_liketovote = $_POST["mem_liketovote"];
	$dob = $_POST["mem_dob"];
	$passport = $_POST["mem_passport"];
	
	$ukaddress = $_POST["mem_ukaddress"];
	$nepaladdress = $_POST["mem_nepaladdress"];
	$mem_phone = $_POST["mem_phone"];
	$mem_income = $_POST["mem_income"];
	$mem_income_others = $_POST["mem_income_others"];
	$mem_profession = $_POST["mem_profession"];
	$mem_prof_others = $_POST["mem_prof_others"];
        //$passport_members = $_POST["passport_proof"];
       // $address_proof = $_POST["address_proof"];
	$createdby = $_SESSION['last_id'];
	$memberstatus = "pending";
$vot_amt = 0;
print_r($address_proof);
	for ($count = 0; $count < count($relation); $count++)
	{   $relation_clean = $relation[$count];
		$name_clean = $name[$count];
		$email_clean = $email[$count];
        $mem_vote = $mem_liketovote[$count];
		$dob_clean = $dob[$count];
		
		$ukaddress_sing = $ukaddress[$count];
		$nepaladdress_sing = $nepaladdress[$count];
		$mem_phone_sing = $mem_phone[$count];
		$mem_income_sing = $mem_income[$count];
		$mem_income_others_sing = $mem_income_others[$count];
		$mem_profession_sing = $mem_profession[$count];
		$mem_prof_others_sing = $mem_prof_others[$count];
		
		
		$passport_clean = $passport[$count];
		$password = randomPassword();
 if($name_clean!=''):
        if($mem_vote=='Yes'):
        $vot_amt =$vot_amt+10;
        else:
        $vot_amt =$vot_amt+5;
        endif;
        endif;

		if ($relation_clean != '' && $name_clean != '')
		{
$validemail = checkEmail($email_clean);
if (($validemail == 'invalid')) {
 $check2 = 1;
    
} else {
   $check2 = userAvailable($pdodb, $email_clean);
}
			if ($check2 == 0)
			{
$email_type = 'Direct';
       
				$pdodb->query('INSERT INTO nrna_members(`member_name`, `email`, `password`, `dob`, `passport_num`, `member_relation`, `mem_status`, `member_since`, `created_by`, `like_to_vote`, `email_type`, `phone`, `profession`, `profession_others`, `income`, `income_others`, `uk_address`, `nepal_address`) 
							VALUES("' . $name_clean . '", "' . $email_clean . '", "' . $password . '", "' . $dob_clean . '", "' . $passport_clean . '", "' . $relation_clean . '", "' . $memberstatus . '", now(), "' . $createdby . '", "' . $mem_vote . '", "' . $email_type . '", "' . $mem_phone_sing . '", "' . $mem_profession_sing . '", "' . $mem_prof_others_sing . '", "' . $mem_income_sing . '", "' . $mem_income_others_sing . '", "' . $ukaddress_sing . '", "' . $nepaladdress_sing . '")');
				$lid = $pdodb->lastInsertId();

				// Sending Confirmation Email

				$params = array(
					'user_id' => $lid,
					'email' => $email_clean,
					'name' => $name_clean,
					'password' => $password
				);

				// signupConfirm($params);
				array_push($_SESSION['emailArr'], $params);
			}else{
$uname = generateRandomString(10);

$check3 = userAvailable($pdodb, $uname);
if ($check3 == 0){

$email_type = 'No Emails';
        $pdodb->query('INSERT INTO nrna_members(`member_name`, `email`, `password`, `dob`, `passport_num`, `member_relation`, `mem_status`, `member_since`, `created_by`, `like_to_vote`, `email_type`, `phone`, `profession`, `profession_others`, `income`, `income_others`, `uk_address`, `nepal_address`) 
							VALUES("' . $name_clean . '", "' . $uname . '", "' . $password . '", "' . $dob_clean . '", "' . $passport_clean . '", "' . $relation_clean . '", "' . $memberstatus . '", now(), "' . $createdby . '", "' . $mem_vote . '", "' . $email_type . '", "' . $mem_phone_sing . '", "' . $mem_profession_sing . '", "' . $mem_prof_others_sing . '", "' . $mem_income_sing . '", "' . $mem_income_others_sing . '", "' . $ukaddress_sing . '", "' . $nepaladdress_sing . '")');
				$lid = $pdodb->lastInsertId();
}else{
$uname = generateRandomString(10);
}

      }
		}
	}
  $_SESSION['vot_amt'] = $vot_amt;
$amount=0;
	// print_r($_SESSION['emailArr']);

	$memCount = sizeof($_SESSION['emailArr']);
	//$amount = 10 * $memCount;
  $total = $_SESSION['main_vote']+$_SESSION['vot_amt'];
  $amount = $amount + $total;
	$_SESSION['pay_amount'] = $amount;
	$params[] = array(
		'user_id' => $_SESSION['last_id'],
		'amount' => $amount,
		'name' => $_SESSION['reg_fullname'],
		'email' => $_SESSION['reg_email']
	);


	echo json_encode($params);
}

// Password reset form. Landing page

if (isset($_GET["tk"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "pwd-reset")
{
	$email = $_GET["em"];
	$tk = $_GET["tk"];
	$rstQry = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND password = ? AND password !=''");
	$data = array(
		$email,
		$tk
	);
	$rstQry->execute($data);
	$count = $rstQry->rowCount();
	if ($count == 1)
	{
		$dt = $rstQry->fetch(PDO::FETCH_OBJ);
		$uemail = $dt->email;
	}
	else
	{
		$err_msg = $helper_msg['pwd_reset_invalid'];
		$uemail = '';
	}
}

// Password recovery form

if (isset($_POST["pwd_recovery"], $_POST["newpass"]) && $_POST["newpass"] != "")
{
	if ($_POST["newpass"] == $_POST["confpass"])
	{
		$email = $_POST["em"];
		$tk = $_POST["tk"];
		$stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND password = ? AND password !=''");
		$data = array(
			md5($email) ,
			$tk
		);
		$stmt->execute($data);
		$count = $stmt->rowCount();
		if ($count == 1)
		{
			$password = $_POST["newpass"];
			$updQry1 = $pdodb->prepare("UPDATE nrna_members SET password = ? WHERE MD5(email) = ? ");
			$data = array(
				$password,
				md5($email)
			);
			$upd1 = $updQry1->execute($data);
			if ($upd1)
			{
				passwordRecovery_acknowledge($email);
				$succ_msg = $helper_msg['pwdreset_succ'];
				$uemail = '';
			}
			else
			{
				$err_msg = $helper_msg['userconfirm_err2'];
			}
		}
		else
		{
			$err_msg = $helper_msg['pwd_reset_invalid'];
		}
	}
	else
	{
		$err_msg = $helper_msg['password_mismatch'];
	}
}

// Conforming the email address and account activation

if (isset($_GET["u"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "user-confirm")
{

	// User availability Check

	$email = $_GET["em"];
	$uid = $_GET["u"];
	$stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending'");
	$data = array(
		$email,
		$uid
	);
	$stmt->execute($data);
	$count = $stmt->rowCount();
	if ($count == 1)
	{
		$updQry = $pdodb->prepare("UPDATE nrna_members SET mem_status='active' WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending' ");
		$data = array(
			$email,
			$uid
		);
		$upd = $updQry->execute($data);
		if ($upd)
		{
			$succ_msg = $helper_msg['userconfirm_succ'];
		}
		else
		{
			$err_msg = $helper_msg['userconfirm_err2'];
		}
	}
	else
	{
		$err_msg = $helper_msg['userconfirm_err1'];
	}
}

if (isset($_POST["action"]) && $_POST["action"] == 'updatepass')
{
	$userid = $_POST["userid"];
	$oldpassword = $_POST["oldpassword"];
	$newpassword = $_POST["newpassword"];
	$stmt = $pdodb->prepare("SELECT password FROM nrna_members WHERE password = ? AND member_id = ?");
	$data = array(
		$oldpassword,
		$userid
	);
	$stmt->execute($data);
	$count = $stmt->rowCount();
	if ($count > 0)
	{
		$updQry = $pdodb->prepare("UPDATE nrna_members SET password = ? WHERE member_id = ?");
		$data = array(
			$newpassword,
			$userid
		);
		$upd = $updQry->execute($data);
	}
}
function checkEmail($email){
if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
{ 
return 'invalid';
}else{
return 'valid';
}
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>