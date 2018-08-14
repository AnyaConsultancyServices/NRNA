<?php 

$valid_formats = array("jpg","jpeg","png","7z","pdf","xlsx","xls","docx","doc","txt");

include ("library/db_config.php");

include ("library/functions.php");

    // PayPal Url - Sandbox

/*
    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 

    $busId = 'treasury.nrnauk-facilitator@gmail.com';

*/

    // PayPal Url - Live

        $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     

        $busId = 'treasury.nrnauk@gmail.com'; 

?>

<!doctype html>

<html lang="en">

   <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <title></title>

      <!-- Stylesheets -->

      <link href="css/bootstrap.min.css" rel="stylesheet">

      <link rel="stylesheet" href="css/login.css">

      <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <!--Google Fonts-->

      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>

      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>



      <script type="text/javascript">

        function googleTranslateElementInit() {

          new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');

        }

      </script>



      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



   </head>

<?php 
if (isset($_POST['mem_relation']))

{

	$relation = $_POST["mem_relation"];

	$sign_name = $_POST["mem_name"];

	$email = $_POST["mem_email"];

	$mem_liketovotes = $_POST["mem_liketovote"];

	$dob = $_POST["mem_dob"];

	$passport = $_POST["mem_passport"];

	

	$ukaddress = $_POST["mem_ukaddress"];

	$nepaladdress = $_POST["mem_nepaladdress"];

  $mem_phone_code = $_POST["mem_contact_code"];

	$mem_phone = $_POST["mem_phone"];

	$mem_income = $_POST["mem_income"];

	$mem_income_others = $_POST["mem_income_others"];

	$mem_profession = $_POST["mem_profession"];

	$mem_prof_others = $_POST["mem_prof_others"];

        $passport_members = $_POST["passport_proof"];

        $passport_members_last = $_POST["passport_last_proof"];

        $address_proof = $_POST["address_proof"];

	$createdby = $_SESSION['last_id'];

	$memberstatus = "pending";

$vot_amt = 0;



$max_file_size = 10*1024*1024; //5MB

$path = "uploads/memberimages/"; // Upload directory

//$count = 0; // nr.successfully uploaded files

//$valid_formats = array("jpg","png","7z","pdf","xlsx","xls","docx","doc","txt");



//prevent uploading from wrong file types(server secure)





	

	

//print_r($address_proof);

	for ($count = 0; $count < count($relation); $count++)

	{   $relation_clean = $relation[$count];

		$name_clean = $sign_name[$count];

		$email_clean = $email[$count];

    $mem_vote = $mem_liketovotes[$count];

		$dob_clean = $dob[$count];

		

		$ukaddress_sing = $ukaddress[$count];

		$nepaladdress_sing = $nepaladdress[$count];

    $mem_phone_code_sing = $mem_phone_code[$count];

		$mem_phone_volt = $mem_phone[$count];

    $mem_phone_sing = $mem_phone_code_sing.' - '.$mem_phone_volt;

		$mem_income_sing = $mem_income[$count];

		$mem_income_others_sing = $mem_income_others[$count];

		$mem_profession_sing = $mem_profession[$count];

		$mem_prof_others_sing = $mem_prof_others[$count];

		

		

		$passport_clean = $passport[$count];

		$password = randomPassword();



if(isset($_FILES['passport_proof'])){

$name = $_FILES['passport_proof']['name'][$count];

		if ($_FILES['passport_proof']['error'][$count] == 0) {

			if ($_FILES['passport_proof']['size'][$count] > $max_file_size) {

				echo $message[] = "$name is too large!";

continue; // Skip large files

			}

			elseif(!in_array(pathinfo(strtolower($name), PATHINFO_EXTENSION), $valid_formats)){

print_r($_FILES['passport_proof']['error'][$count]);

				echo $message[] = "$name is not a valid format";

				continue; // Skip invalid file formats

			}

			else{ 

			$passport_prName = date("m-d-Y-h-i-s", time())."-".$name;



			// No error found! Move uploaded files

				//if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))

					move_uploaded_file($_FILES["passport_proof"]["tmp_name"][$count], $path.$passport_prName);

					//$count++; // counting successful uploadings

$passportpath = 'uploads/memberimages/'.$passport_prName;

			}

	}

}



if(isset($_FILES['passport_last_proof'])){

$name = $_FILES['passport_last_proof']['name'][$count];

		if ($_FILES['passport_last_proof']['error'][$count] == 0) {

			if ($_FILES['passport_last_proof']['size'][$count] > $max_file_size) {

				echo $message[] = "$name is too large!";

continue; // Skip large files

			}

			elseif(!in_array(pathinfo(strtolower($name), PATHINFO_EXTENSION), $valid_formats)){

print_r($_FILES['passport_last_proof']['error'][$count]);

				echo $message[] = "$name is not a valid format";

				continue; // Skip invalid file formats

			}

			else{ 

			$passport_prName_lst = date("m-d-Y-h-i-s", time())."-".$name;



			// No error found! Move uploaded files

				//if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))

					move_uploaded_file($_FILES["passport_last_proof"]["tmp_name"][$count], $path.$passport_prName);

					//$count++; // counting successful uploadings

$passportpath_last = 'uploads/memberimages/'.$passport_prName_lst;

			}

	}

}






if(isset($_FILES['address_proof'])){

$adr_name = $_FILES['address_proof']['name'][$count];

		if ($_FILES['address_proof']['error'][$count] == 0) {

			if ($_FILES['address_proof']['size'][$count] > $max_file_size) {

				echo $message[] = "$adr_name is too large!";

continue; // Skip large files

			}

			elseif(!in_array(pathinfo(strtolower($adr_name), PATHINFO_EXTENSION), $valid_formats)){

print_r($_FILES['address_proof']['error'][$count]);

				echo $message[] = "$adr_name is not a valid format";

				continue; // Skip invalid file formats

			}

			else{ 

			$address_prName = date("m-d-Y-h-i-s", time())."-".$adr_name;



			// No error found! Move uploaded files

				//if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))

					move_uploaded_file($_FILES["address_proof"]["tmp_name"][$count], $path.$address_prName);

					//$count++; // counting successful uploadings

$addrspath = 'uploads/memberimages/'.$address_prName;

			}

	}

}

 if($name_clean!=''):

        if($mem_vote=='Yes'):

        $vot_amt =$vot_amt+10;

$liketivote = 'Yes';

        else:

        $vot_amt =$vot_amt+5;

$liketivote = 'No';

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

       

				$pdodb->query('INSERT INTO nrna_members(`member_name`, `email`, `password`, `dob`, `passport_num`, `member_relation`, `mem_status`, `member_since`, `created_by`, `like_to_vote`, `email_type`, `phone`, `profession`, `profession_others`, `income`, `income_others`, `uk_address`, `nepal_address`, `passport_img`, `passport_last_page`, `address_proof`) 

							VALUES("' . $name_clean . '", "' . $email_clean . '", "' . $password . '", "' . $dob_clean . '", "' . $passport_clean . '", "' . $relation_clean . '", "' . $memberstatus . '", now(), "' . $createdby . '", "' . $liketivote . '", "' . $email_type . '", "' . $mem_phone_sing . '", "' . $mem_profession_sing . '", "' . $mem_prof_others_sing . '", "' . $mem_income_sing . '", "' . $mem_income_others_sing . '", "' . $ukaddress_sing . '", "' . $nepaladdress_sing . '", "'.$passportpath.'","'. $passportpath_last .'",  "'. $addrspath .'")');

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

        $pdodb->query('INSERT INTO nrna_members(`member_name`, `email`, `password`, `dob`, `passport_num`, `member_relation`, `mem_status`, `member_since`, `created_by`, `like_to_vote`, `email_type`, `phone`, `profession`, `profession_others`, `income`, `income_others`, `uk_address`, `nepal_address`, `passport_img`, `address_proof`) 

							VALUES("' . $name_clean . '", "' . $uname . '", "' . $password . '", "' . $dob_clean . '", "' . $passport_clean . '", "' . $relation_clean . '", "' . $memberstatus . '", now(), "' . $createdby . '", "' . $liketivote . '", "' . $email_type . '", "' . $mem_phone_sing . '", "' . $mem_profession_sing . '", "' . $mem_prof_others_sing . '", "' . $mem_income_sing . '", "' . $mem_income_others_sing . '", "' . $ukaddress_sing . '", "' . $nepaladdress_sing . '", "'.$passportpath.'", "'. $addrspath .'")');

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



echo '<script>window.location.href = window.location.href = "http://nrna.co.uk/view.php?id='.$_SESSION['last_id'].'";</script>';	

	

}



?>

   <body>

      <div class="se-pre-con"></div>

      <div class="inner nrna">

         <!-- wrapper of the page -->

         <div id="wrapper">

            <!-- header of the page -->

            <header id="header">

               <div class="top-header">

                  <div class="container">

                     <!-- logo -->

                     <div class="logo">

                        <h1>

                           <span class="sr-only">Non Resident Nepali Association</span>

                           <a id="dnn_dnnLOGO_hypLogo" title="NRNA" href="https://bw.nrna.org/"><img id="dnn_dnnLOGO_imgLogo" class="circle" src="./img/logo.png" alt="NRNA"></a>

                           <span class="slogan">

                           <img src="./img/slogan-text.png" alt="Non Resident Nepali Association">

                           </span>

                           <span class="ncc-name"> NRNA

                           </span>

                        </h1>

                     </div>

                  </div>

               </div>

            </header>

            <!-- main informative parts of page -->

            <main id="main">

               <div class="content-container container">

                  <!-- content of the page -->

                  <div id="content">

                     <!-- inner page article -->

                     <article class="page-article">

                        <div id="dnn_ContentPane" class="DNNEmptyPane"></div>

                     </article>

                  </div>

               </div>

            </main>

         </div>

      </div>

      <div id="main-wrapper">

         <div class="cotn_principal">

            <div class="alert alert-success" style="margin: 10px; display: none;">

               <strong>Success!</strong> We have sent confirmation link to your Email ID.

            </div>

            <div id="google_translate_element" style="margin: 10px; float: right;"></div>

            <form role="form" name="signupForm" id="signupForm" action="" method="post" enctype="multipart/form-data">

               <div id="msform">

                  <!-- progressbar -->

                  <ul id="progressbar">

                     <li class="active">Account Setup</li>

                     <li>Personal Details</li>

                     <li>Identification proofs</li>

                  </ul>

                  <!-- fieldsets -->

                  <fieldset>

                     <h2 class="fs-title">Create your account</h2>

                     <input type="text" id="fullname" name="fullname" placeholder="First Name *" value="" autocomplete="off" />

                     <input type="text" id="lname" name="lname" placeholder="Last Name *" value="" autocomplete="off" />

                     <input type="text" id="email" name="email" placeholder="Email *" value="" autocomplete="off" onBlur="checkAvailability()" style="margin-bottom: 0px;" /><span id="email-availability-status"></span>

                     <p><img src="img/LoaderIcon.gif" id="loaderIcon" style="display:none;" /></p>

                     <input type="password" id="password" name="password" value="" placeholder="Password *" autocomplete="off" />

                     <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password *" autocomplete="off" /></br>

                     <input type="button" name="next" class="next action-button" value="Next" />

                     <p class="">

                        <small>Already have an account?  <a href="login.php">Login Now</a></small>

                     </p>

                  </fieldset>

                  <fieldset>

                     <h2 class="fs-title">Personal Details</h2>

                     <!--<h3 class="fs-subtitle">We will never sell it</h3>-->



                    <div id="regShrtInfo">

                     <strong> Note :</strong><br> 1. NRNA UK Membership fee for Voting member is £10 and for non-voting member is £5.<br>2. All members will get their NRNA UK ID card from NRNA UK Administrator.

                    </div>



                     <select id="contact_code" name="contact_code" style="width: 20%; margin-right: 1%; float: left; padding: 15px 2px 15px 8px;">

                     	<option value="+44" selected="selected">+44</option><option value="+1">+1</option> <option value="+91">+91</option><option value="+977">+977</option>

                     </select>



                     <input type="text" id="phone" name="phone" value="" placeholder="Contact Number *" autocomplete="off" style="width: 79%; padding: 14px 0;" />



<select id="profession" name="profession" style="width: 100%; margin-right: 1%; margin-bottom: 10px;  padding: 15px 2px 15px 8px;">

<option value="">- Select Your Profession -</option>

                     	<option value="Professional">Professional</option><option value="Unemployed">Unemployed</option> <option value="Business">Business</option><option value="Student">Student</option><option value="Others">Others</option>

                     </select>

  <input type="text" id="prof_others" name="prof_others" value="" placeholder="Other Profession" autocomplete="off" style="width: 100%; padding: 14px 0; display:none" />





<select id="income" name="income" style="width: 100%; margin-bottom: 10px; margin-right: 1%;padding: 15px 2px 15px 8px;">

<option value="">Select Income</option>

                     	<option value="type-income" >Type Income</option><option value="NoIncome">No Income</option> <option value="Dont wish to specify">Don't wish to specify</option>

                     </select>

 <input type="text" id="income_others" name="income_others" value="" placeholder="Type Annual Income (approx. in GBP)" autocomplete="off" style="width: 100%; padding: 14px 0; display:none" />

                     <input type="text" class="datepicker" id="dob" name="dob" placeholder="Date of Birth *" value="" autocomplete="off" />

                     <textarea id="ukaddress" name="ukaddress" placeholder="UK Address *"></textarea>

                     <textarea id="nepaladdress" name="nepaladdress" placeholder="Nepal Address *"></textarea>



<div class="voting">

<label>Would You Like to Vote?</label>



<div id="like2voteRdo">

  <label><input type="radio" name="liketovote" id="liketovote1" checked="checked" value="Yes"> Yes </label>

  <label><input type="radio" name="liketovote" id="liketovote2" value="No"> No </label>

</div>





<!-- 

<select id="liketovote" name="liketovote" style="width: 20%; margin-bottom: 10px; margin-right: 1%;padding: 5px 2px 6px 8px;">

<option value="No" >No</option><option value="Yes">Yes</option> </select>

-->

</div>



                     </br>

                     <input type="button" name="previous" class="previous action-button" value="Previous" />

                     <input type="button" name="next" class="next action-button" value="Next" />

                  </fieldset>

                  <fieldset>

                     <h2 class="fs-title">Identification proofs</h2>

                     <!--<h3 class="fs-subtitle">Your presence on the social network</h3>-->



                     <div id="regShrtInfo">

                     <strong> Note :</strong><br> 1. NRNA UK Membership fee for Voting member is £10 and for non-voting member is £5.<br>2. All members will get their NRNA UK ID card from NRNA UK Administrator.

                    </div>



                     <input type="text" name="passport_number" id="passport_number" placeholder="Passport Number *" autocomplete="off" style="text-transform: lowercase" />

                     <div class="upload-btn-wrapper">

                        <button class="btn">Upload your Passport First Page  *<span class="pass-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>

                        <input type="file" name="passprtimg" id="passprtimg" />

                     </div>



  <div class="upload-btn-wrapper">

                        <button class="btn">Upload your Passport Last Page  *<span class="pass-uploaded-2" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>

                        <input type="file" name="passprtlastimg" id="passprtlastimg" />

                     </div>





                     <div class="upload-btn-wrapper">

                        <button class="btn">Upload your Address proof <span class="proof-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>

                        <input type="file" name="addressproof" id="addressproof" />

                     </div>

                     <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#addMemberModal">Add Family Members <span><i class="fa fa-plus-circle fa-lg"></i></button>



                    <div id="divTermChkBoxes">

                      <div>

                        <input type="checkbox" value="" id="chkBoxCnfInfo" name="nrnaAcceptInfo"> &nbsp; I agree to my information being processed by NRNA – UK to contact me via phone, email, or other means regarding information relevant to my professional interests. I may unsubscribe at any time.

                      </div>

                      <div>

                        <input type="checkbox" value="" id="chkBoxAccTerm" name="nrnaAcceptTerms"> &nbsp; I agree the terms and conditions of NRNA-UK.



                      </div>

                    </div>



                     <input type="button" name="previous" class="previous action-button" value="Previous" />

                     <input type="submit" name="submit" class="submit action-button" value="Submit" />

                  </fieldset>

               </div>

            </form>

            

            <?php include "footer.php"; ?>

         </div>

      </div>

      <!-- end #main-wrapper -->

      <div id="addMemberModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">

         <div class="modal-dialog modal-lg">

            <form role="form" name="addMemberForm" id="addMemberForm" action="#" method="post" enctype="multipart/form-data">

               <div class="modal-content">

                  <div class="modal-header">

                     <button type="button" class="close" data-dismiss="modal">&times;</button>

                     <h4 class="modal-title" id="classModalLabel">

                        <b> Enter Family Member Details </b>

                     </h4>

                  </div>

                  <div class="modal-body" style="overflow-x: auto;">

<label class="error emails_1"></label>

<div id="familytable" class="member-forms">

<div id="row_1" class="inner-section">

                   

                                 <select name="mem_relation[]" required="required">

                                    <option value="">Select Relation</option>

                                    <option value="mother">Mother</option>

                                    <option value="father">Father</option>

                                    <option value="sister">Sister</option>

                                    <option value="brother">Brother</option>

                                    <option value="wife">Wife</option>

                                    <option value="son">Son</option>

                                    <option value="daughter">Daughter</option>

                                    <option value="others">Others</option>

                                 </select>

                            

                                 <input type="text" name="mem_name[]" value="" required="required" placeholder="Member Name" autocomplete="off">

                            

                                 <input type="text" class="datepicker" placeholder="DOB" name="mem_dob[]" value="" required="required" autocomplete="off">

                             

                                 <input type="email"  placeholder="Email/Username" name="mem_email[]" value="" required="required" autocomplete="off" onkeyup="checkEmail(this.id);">

                             

                                 <input type="text" placeholder="Passport Number" name="mem_passport[]" required="required" autocomplete="off">

                              

                                 <select  name="mem_contact_code[]" style="width: 9%; margin-right: 1%; " class="valid" aria-invalid="false">

                     	<option value="+44" selected="selected">+44</option><option value="+1">+1</option> <option value="+91">+91</option><option value="+977">+977</option>

                     </select><input type="text" name="mem_phone[]" placeholder="phone number" required="required" autocomplete="off">

                              

                                 <select  name="mem_income[]" id="inc_1" style="padding:3px;" onChange="memIncome(this.value, this.id)">

<option value="">Select Income</option>

                     	<option value="type-income" >Type Income</option><option value="NoIncome">No Income</option> <option value="Dont wish to specify">Don't wish to specify</option>

                     </select>

                     <input class="income inc_1" type="number" id="" name="mem_income_others[]" value="" placeholder="Type Annual Income (approx. in GBP)" autocomplete="off" style="display:none" />

                            <select  name="mem_profession[]" style="padding: 3px;" id="prof_1" onChange="memProfession(this.value, this.id)">

<option value="">- Select Profession - </option>

                     	<option value="Professional">Professional</option><option value="Unemployed">Unemployed</option> <option value="Business">Business</option><option value="Student">Student</option><option value="Others">Others</option>

                     </select>

  <input type="text" class="professor prof_1"  name="mem_prof_others[]" value="" placeholder="Other Profession" autocomplete="off" style="display:none" />

  <textarea  name="mem_ukaddress[]" placeholder="UK Address *"></textarea>

<textarea  name="mem_nepaladdress[]" placeholder="Nepal Address *"></textarea>

<p><span style="padding-right:5px;">Like to Vote?</span><select  name="mem_liketovote[]" style="width: 20%; margin-bottom: 10px; margin-right: 1%;padding: 5px 2px 6px 8px;">

                      <option value="No" >No</option><option value="Yes">Yes</option> </select></p> 

<p>

                  <span> Upload Passport First Page :</span> <input type="file" name="passport_proof[]" placeholder="Upload Passport" />

</p>

<p>

                  <span> Upload Passport Last Page :</span> <input type="file" name="passport_last_proof[]" placeholder="Upload Passport" />

</p>

<p>

                  <span> Upload Address proof : </span><input type="file" name="address_proof[]" placeholder="Upload Address proof" />

</p>

                  <a onclick="removeRow('row_1')" class="btn btn-danger btn-yellow">x</a>

                  </div>

                     </div>

                     <a href="#" class="btn-sm btn-success pull-right" id="insert-more" style="text-decoration: none;"> <i class="fa fa-plus-circle fa-lg"></i> &nbsp; One more</a>

                     

                  </div>

                  <div class="modal-footer">

                     <button type="button" class="btn-sm btn-primary" id="addmembersto" data-dismiss="modal">

                     Add Member(s)

                     </button>

                  </div>

               </div>

            </form>

         </div>

      </div>

      <!-- end #addMemberModal -->

      <div class="modal fade" id="OTPModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">

         <div class="modal-dialog" role="document">

            <div class="modal-content" style="width: 320px; height: auto;">

               <div class="modal-header">

                  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->

                  <h4 class="modal-title">OTP Verification</h4>

                  <span class="has-error err-alt" style="display: none; color: red;">Sorry, OTP is worng.</span>

               </div>

               <form role="form" id="OTPform" name="OTPform" action="" method="post">

                  <div class="modal-body">

                     <p>We have sent OTP to your mobile number.</p>

                     <input type="text" name="otpvalue" id="otpvalue" value="" />

                     <input type="submit" name="submit" class="submit action-button" value="Submit" />

                  </div>

                  <!--<div class="modal-footer">

                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                      </div>-->

               </form>

            </div>

            <!-- /.modal-content -->

         </div>

         <!-- /.modal-dialog -->

      </div>

      <!-- /.modal -->

   </body>

</html>





<form action="<?php echo $paypal_url; ?>" method="post" name="nrnaForm">



    <input type="hidden" name="business" value="<?php echo $busId; ?>">

    <input type="hidden" name="cmd" value="_xclick">

    <input type="hidden" name="item_name" value="NRNA-UK">

    <input type="hidden" name="item_number" id="item_number" value="1">

    <input type="hidden" name="amount" id="pay_amount" value="">

    <input type="hidden" name="currency_code" value="GBP">

    <input type="hidden" name="first_name" id="pay_name" value="">

    <input type="hidden" name="email" id="pay_email" value="">

    <input type='hidden' name='notify_url' value='http://nrna.co.uk/pp_notify.php'>

    <input type='hidden' name='cancel_return' value='http://nrna.co.uk/pp_cancel.php'>

    <input type='hidden' name='return' value='http://nrna.co.uk/payment_success.php'>



</form>





<!-- Scripts -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="js/bootstrap.min.js"></script>

<!-- JQuery Validation Plugin -->

<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<script src="js/validation-methods.js" type="text/javascript"></script>



<script type="text/javascript">



  $(document).ready(function() { 

      $(window).keydown(function(event) {

          if (event.keyCode == 13) {

              event.preventDefault();

              return false;

          }

      });

  });





  $(function() {



      $(".se-pre-con").fadeOut("slow");



      //$("#dob").datepicker({ dateFormat: 'dd-mm-yy' });



      var d = new Date(70,0,1);

      $(".datepicker").datepicker({

          defaultDate:d,

          dateFormat: 'dd-mm-yy',

          showButtonPanel: true,

          changeMonth: true,

          changeYear: true,

          yearRange: "1950:2030",

          showOtherMonths: true,

          selectOtherMonths: true

      });



var i = 1;

      $("#insert-more").click(function() {

i++;



          $("#familytable").each(function() {

                var tds = '<div id="row_'+i+'" class="inner-section"><select name="mem_relation[]" required="required"><option value="">Select Relation</option><option value="mother">Mother</option><option value="father">Father</option><option value="sister">Sister</option><option value="brother">Brother</option><option value="wife">Wife</option><option value="son">Son</option><option value="daughter">Daughter</option><option value="others">Others</option></select><input type="text" name="mem_name[]" value="" required="required" placeholder="Member Name" autocomplete="off"><input type="text" class="datepicker" placeholder="DOB" name="mem_dob[]" value="" required="required" autocomplete="off"><input type="email"  placeholder="Email/Username" name="mem_email[]" value="" required="required" autocomplete="off" onkeyup="checkEmail(this.id);"><input type="text" placeholder="Passport Number" name="mem_passport[]" required="required" autocomplete="off"><select  name="mem_contact_code[]" style="width: 9%; margin-right: 1%; " class="valid" aria-invalid="false"><option value="+44" selected="selected">+44</option><option value="+1">+1</option> <option value="+91">+91</option><option value="+977">+977</option></select><input type="text" name="mem_phone[]" placeholder="phone number" required="required" autocomplete="off"><select id="inc_'+i+'"  name="mem_income[]" style="padding:3px;" onChange="memIncome(this.value, this.id)"><option value="">Select Income</option><option value="type-income" >Type Income</option><option value="NoIncome">No Income</option> <option value="Dont wish to specify">Dont wish to specify</option></select><input type="number" class="income inc_'+i+'" name="mem_income_others[]" value="" placeholder="Type Annual Income (approx. in GBP)" autocomplete="off" style="display:none" /><select id="prof_'+i+'"  name="mem_profession[]" style="padding: 3px;" onChange="memProfession(this.value, this.id)"><option value="">- Select Profession -</option><option value="Professional">Professional</option><option value="Unemployed">Unemployed</option> <option value="Business">Business</option><option value="Student">Student</option><option value="Others">Others</option></select><input type="text" class="professor prof_'+i+'"  name="mem_prof_others[]" value="" placeholder="Other Profession" autocomplete="off" style="display:none" /><textarea  name="mem_ukaddress[]" placeholder="UK Address *"></textarea><textarea  name="mem_nepaladdress[]" placeholder="Nepal Address *"></textarea><p><span style="padding-right:5px;">Like to Vote?</span><select  name="mem_liketovote[]" style="width: 20%; margin-bottom: 10px; margin-right: 1%;padding: 5px 2px 6px 8px;"><option value="No" >No</option><option value="Yes">Yes</option> </select></p><p><span> Upload Passport First Page :</span><input type="file" name="passport_proof[]" placeholder="Upload Passport" /></p><p><span> Upload  Passport Last Page :</span><input type="file" name="passport_last_proof[]" placeholder="Upload Passport" /></p><p><span> Upload Address :</span><input type="file" name="address_proof[]" placeholder="Upload Passport" /></p><a onclick="removeRow('+"'row_"+i+"'"+')" class="btn btn-danger btn-yellow">x</a></div>';

              if ($('tbody', this).length > 0) {

                  $('tbody', this).append(tds);

              } else {

                  $(this).append(tds).trigger("create");

              }

          });

var d = new Date(90,0,1);

                $(".datepicker").datepicker({

                    defaultDate:d,

                    dateFormat: 'dd-mm-yy',

                    showButtonPanel: true,

                    changeMonth: true,

                    changeYear: true,

                    yearRange: "1950:2030",

                    showOtherMonths: true,

                    selectOtherMonths: true,

                });

      });

  });





 /* function validateEmail($email) {

      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

      return emailReg.test($email);

  }*/



  function checkAvailability() {



      //if (validateEmail($("#email").val())) {



          $("#loaderIcon").show();

          jQuery.ajax({

              url: "library/user_controller.php",

              data: 'checkuseremail=' + $("#email").val(),

              type: "POST",

              success: function(data) {

if(data == "<span class='status-msg status-available' style='color:#cc5965'>Email Already Used</span>"){

$('.next').hide();

}else{

$('.next').show();

}

$('.status-msg').hide();

                  $("#email-availability-status").html(data);

                  $("#loaderIcon").hide();

              },

              error: function() {}

          });



      //}

  }





function checkEmail(ids) {



$('#insert-more').hide();

$('#addmembersto').hide();

      //if (validateEmail($("#email").val())) {



          $("#loaderIcon").show();

          jQuery.ajax({

              url: "library/user_controller.php",

              data: 'checkuseremail=' + $("#"+ids).val(),

              type: "POST",

              success: function(data) {

                  $(".emails_1").html(data);

                  $("#loaderIcon").hide();

if(data!='Email Already Used'){

$('#insert-more').show();

$('#addmembersto').show();

}else{

$('#insert-more').hide();

$('#addmembersto').hide();

}

              },

              error: function() {}

          });



      //}

  }



  $(document).ready(function() {



    $("#phone").focusout(function(e) {



          alert('We will send an OTP to the given number. '+e.target.value);



          if (e.target.value != '') {



              $(".se-pre-con").fadeIn("slow");



              var phnno = $("#contact_code").val() + $("#phone").val();



              if (phnno != '') {



                  jQuery.ajax({

                      url: "library/otp_controller.php",

                      data: 'phone=' + phnno,

                      type: "POST",

                      success: function(data) {

                          $('#OTPModal').modal('show');

                          $(".se-pre-con").fadeOut("slow");

                      },

                      error: function() {}

                  });

              }



          }



      });

      $('#OTPform').validate({

          rules: {

              otpvalue: {

                  required: true

              }

          },

          highlight: function(element) {

              $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

          },

          submitHandler: function(form) {



              $(".se-pre-con").fadeIn("slow");



              var otpval = $("#otpvalue").val();



              $.post(

                  "library/otp_controller.php", {

                      "otpvalue": otpval

                  },

                  function(data) {

                      //console.log(data);

                      $(".se-pre-con").fadeOut("slow");



                      if (data == 'success') {



                          $('#OTPModal').modal('hide');



                      } else {



                          $(".err-alt").css("display", "block");



                      }

                  }

              );

          }

      });

  });





  //jQuery time

  (function($) {

      var current_fs, next_fs, previous_fs; //fieldsets

      var left, opacity, scale; //fieldset properties which we will animate

      var animating; //flag to prevent quick multi-click glitches



      $(".next").click(function() {



          var signupForm = $("#signupForm");

var validates = signupForm.valid();

          $('#signupForm').valid();

          console.log("Valid: " + signupForm.valid());



   if (signupForm.valid()=== false)

 return false;



          if (animating)

 return false;

          animating = true;

          current_fs = $(this).parent();

          next_fs = $(this).parent().next();



          //activate next step on progressbar using the index of next_fs

          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");



          //show the next fieldset

          next_fs.show();

          //hide the current fieldset with style

          current_fs.animate({

              opacity: 0

          }, {

              step: function(now, mx) {

                  //as the opacity of current_fs reduces to 0 - stored in "now"

                  //1. scale current_fs down to 80%

                  scale = 1 - (1 - now) * 0.2;

                  //2. bring next_fs from the right(50%)

                  left = (now * 50) + "%";

                  //3. increase opacity of next_fs to 1 as it moves in

                  opacity = 1 - now;

                  current_fs.css({

                      'transform': 'scale(' + scale + ')'

                  });

                  next_fs.css({

                      'left': left,

                      'opacity': opacity

                  });

              },

              duration: 800,

              complete: function() {

                  current_fs.hide();

                  animating = false;

              },

              //this comes from the custom easing plugin

              easing: 'easeInOutBack'

          });

      });



      $(".previous").click(function() {

          if (animating) return false;

          animating = true;



          current_fs = $(this).parent();

          previous_fs = $(this).parent().prev();



          //de-activate current step on progressbar

          $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");



          //show the previous fieldset

          previous_fs.show();

          //hide the current fieldset with style

          current_fs.animate({

              opacity: 0

          }, {

              step: function(now, mx) {

                  //as the opacity of current_fs reduces to 0 - stored in "now"

                  //1. scale previous_fs from 80% to 100%

                  scale = 0.8 + (1 - now) * 0.2;

                  //2. take current_fs to the right(50%) - from 0%

                  left = ((1 - now) * 50) + "%";

                  //3. increase opacity of previous_fs to 1 as it moves in

                  opacity = 1 - now;

                  current_fs.css({

                      'left': left

                  });

                  previous_fs.css({

                      'transform': 'scale(' + scale + ')',

                      'opacity': opacity

                  });

              },

              duration: 800,

              complete: function() {

                  current_fs.hide();

                  animating = false;

              },

              //this comes from the custom easing plugin

              easing: 'easeInOutBack'

          });

      });

  })(jQuery);







  $(document).ready(function() {

$('#profession').on('change', function(){

var val_other = $(this).val();

if(val_other=='Others'){

$('#prof_others').show();

}else{

$('#prof_others').hide();

}

});



$('#income').on('change', function(){

var val_income = $(this).val();

if(val_income=='type-income'){

$('#income_others').show();

}else{

$('#income_others').hide();

}

});

      $('#signupForm').validate({

          rules: {

              fullname: {

                  required: true

              }, 

              lname: {

                  required: true

              },

              email: {

                  required: true,

                  email: true

              },

              password: {

                  required: true,

                  minlength: 8

              },

              confirm_password: {

                  required: true,

                  equalTo: "#password"

              },

              phone: {

                  required: true,

                  digits: true

              },

              dob: {

                  required: true

              },

              ukaddress: {

                  required: true

              },

              nepaladdress: {

                  required: true

              },

              passport_number: {

                  required: true

              },

profession: {

                  required: true

              },

income: {

                  required: true

              },

              passprtimg: {

                  required: true

              },

passprtlastimg: {

                  required: true

              },

          },

          highlight: function(element) {

              $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

          },

          /*success: function (element) {

           element.text('').addClass('valid')

             .closest('.form-group').removeClass('has-error').addClass('has-success');

          },*/

          submitHandler: function(form) { // <- only fires when form is valid



              //alert($('#fullname').val());

              //document.signupForm.submit();



              if($('#divTermChkBoxes input[type="checkbox"]:checked').length == 2){



              $(".se-pre-con").fadeIn("slow");



              var membername = $("#fullname").val();

              var lname      = $("#lname").val();

              var membremail = $("#email").val();

              var password = $("#password").val();

              var phonecode = $("#contact_code").val();

              var phonenum = phonecode +' - '+ $("#phone").val();

              var dateofbirth = $("#dob").val();

              var ukaddress = $("#ukaddress").val();

              var nepaladdress = $("#nepaladdress").val();

              var passnum = $("#passport_number").val();

              var profession = $("#profession").val();

              var liketovote = $('input[name=liketovote]:checked').val();

              var prof_others = $("#prof_others").val();

              var income = $("#income").val();

              var income_others = $("#income_others").val();

              $.post(

                  "library/user_controller.php", {

                      "action": 'register',

                      "fullname": membername,

                      "member_lastname":lname,

                      "email": membremail,



                      "password": password,

                      "phone": phonenum,

                      "dob": dateofbirth,

                      "ukaddress": ukaddress,

                      "nepaladdress": nepaladdress,

                      "passport": passnum,

                      "profession": profession,

                      "liketovote": liketovote ,

                      "prof_others":prof_others,

                      "income":income,

                      "income_others":income_others



 },

                  function(data) {

                      console.log(data);

                      uploadimage();

                      uploadproofs();

                      uploadpassportlast();

                  }

              );



            }else{ alert("Please agree that the information provided by you are correct and agree the Term and Conditions"); }

          }

      });









      var imagefiles;

      var imageproofs;



      $('#passprtimg').on('change', preparePhotoUpload);



      function preparePhotoUpload(event) {
$('.pass-uploaded').css('display', '-webkit-inline-box');
imagefiles = event.target.files;
/*
      	if(checkUplFileSize(event.target.files)){

          $('.pass-uploaded').css('display', '-webkit-inline-box');
          imagefiles = event.target.files;

         }else{
      		$('#passprtimg').val('');
      		$('.pass-uploaded').css('display', 'none');
      		alert('Please upload File with the size less than 2MB');
      	}
*/
      }



 	$('#passprtlastimg').on('change', preparePhotoLastUpload);

	function preparePhotoLastUpload(event) {
$('.pass-uploaded-2').css('display', '-webkit-inline-box');
imagefileslast = event.target.files;
/*
		if(checkUplFileSize(event.target.files)){
		  $('.pass-uploaded-2').css('display', '-webkit-inline-box');
		  imagefileslast = event.target.files;
		}else{
	      		$('#passprtlastimg').val('');
	      		$('.pass-uploaded-2').css('display', 'none');
	      		alert('Please upload File with the size less than 2MB');
	      	}
*/

	}





      $('#addressproof').on('change', prepareProofUpload);



      function prepareProofUpload(event) {
$('.proof-uploaded').css('display', '-webkit-inline-box');
imageproofs = event.target.files;
/*
      	if(checkUplFileSize(event.target.files)){
          $('.proof-uploaded').css('display', '-webkit-inline-box');
          imageproofs = event.target.files;
      	}else{
      		$('#addressproof').val('');
      		$('.proof-uploaded').css('display', 'none');
      		alert('Please upload File with the size less than 2MB');
      	}
*/
      }


$("body").on("change", "#addMemberForm input[type='file']", function () {
/*
	if(this.files[0].size > 2097152 ){
		alert('Please upload File with the size less than 2MB');
		$(this).val('');
	}
*/
});


function checkUplFileSize(fileInfos){
	var ret = true;
	if(fileInfos[0].size > 2097152 ){
		ret = false;
	}
	return ret;
}








      function uploadimage() {



          var data = new FormData();



          //adding file content to data

          $.each(imagefiles, function(key, value) {

              //console.log(value);

              data.append("action", "uploadPassport");

              data.append("passportimg", value);



          });



          $.ajax({

              url: 'library/user_controller.php?files',

              type: 'POST',

              data: data,

              cache: false,

              dataType: 'json',

              processData: false,

              contentType: false,

              success: function(data) {

                  //window.location.reload();

                  console.log(data);

                  $("#addMemberForm").submit();

                  //$(".se-pre-con").fadeOut("slow");

                  //$(".alert-success").slideDown("slow");

              }

          });

      }











function uploadproofs () {



          var data = new FormData();



          //adding file content to data

          $.each(imageproofs , function(key, value) {

              //console.log(value);

              data.append("action", "uploadProofs");

              data.append("addressproof", value);



          });

          $.ajax({

              url: 'library/user_controller.php?files',

              type: 'POST',

              data: data,

              cache: false,

              dataType: 'json',

              processData: false,

              contentType: false,

              success: function(data) {

                  //window.location.reload();

                  console.log('proofs', data);

                  //$("#addMemberForm").submit();

                  //$(".se-pre-con").fadeOut("slow");

                  //$(".alert-success").slideDown("slow");

              }

          });

      }







function uploadpassportlast () {



          var data = new FormData();



          //adding file content to data

          $.each(imagefileslast , function(key, value) {

              //console.log(value);

              data.append("action", "uploadpassportlast");

              data.append("passportlast", value);



          });



          $.ajax({

              url: 'library/user_controller.php?files',

              type: 'POST',

              data: data,

              cache: false,

              dataType: 'json',

              processData: false,

              contentType: false,

              success: function(data) {

                  //window.location.reload();

                  console.log('passportlast', data);

                  //$("#addMemberForm").submit();

                  //$(".se-pre-con").fadeOut("slow");

                  //$(".alert-success").slideDown("slow");

              }

          });

      }





     /* $("#addMemberForm").submit(function(event) {



          event.preventDefault();



          var addForm = $('#addMemberForm').serialize();

          console.log(addForm);

          $.ajax({

              type: 'POST',

              url: 'library/user_controller.php',

              data: addForm,

              success: function(data) {

               var realdata = JSON.parse(data)

               console.log(realdata);

                window.location.href = 'http://nrna.co.uk/view.php?id='+realdata[0]["user_id"];

                  //parseJSON(data);

              }

          });

      });*/





      function parseJSON(string) {

          var result_of_parsing_json = JSON.parse(string);

          console.log(result_of_parsing_json[0]["email"]);



          $('#pay_amount').val(result_of_parsing_json[0]["amount"]);

          $('#pay_name').val(result_of_parsing_json[0]["name"]);

          $('#pay_email').val(result_of_parsing_json[0]["email"]);

          $('#item_number').val(result_of_parsing_json[0]["user_id"]);



          document.nrnaForm.submit();

      }



  }); /* $(document) close */

function removeRow(ids){

$('#'+ids).remove()

}

function memIncome(incomes, ic_id){

	if(incomes=='type-income'){

		$('.'+ic_id).show();

		}else{

			$('.'+ic_id).hide();

			}

	}

	function memProfession(profession, prof){

	if(profession=='Others'){

		$('.'+prof).show();

		}else{

			$('.'+prof).hide();

			}

	}



  function checkAvailabilityMail() {



jQuery.ajax({

              url: "library/user_controller.php",

              data: 'checkuseremail=' + $("#email").val(),

              type: "POST",

              success: function(data) {

if(data == "<span class='status-msg status-available' style='color:#cc5965'>Email Already Used</span>"){

alert(data);

return '';

}

              },

              error: function() {}

          });



}



</script>









<style>  

#msform{ margin: 50px auto 50px !important; }

.cotn_principal{ padding-bottom: 50px; }

#msform fieldset{ position: relative; }



#divTermChkBoxes div{ 

    text-align: justify;

    display: inline-flex;

    font-size: 0.85em;

    width: 100%;

     }

#divTermChkBoxes div input{ width: auto; }

div#regShrtInfo {

    text-align: left; color: #000;

    font-size: 0.75em;

    border: 1px dotted #ccc;

    background: #fff9de;

    padding: 5px 10px;

    margin: 0 0 10px;

}

#like2voteRdo{ 

    float: left;

    width: 50%;

    display: inline-flex;

}



#like2voteRdo input{ width: auto; }



</style>