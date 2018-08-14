<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    $succ_msg = $err_msg = ''; 
    include ('library/db_config.php');
  	include ("library/loginfunctions.php");
  	include ("library/emails.php");

    //session_destroy();

	// Login process
	if (isset($_POST["login"], $_POST["email"]) && $_POST["email"] != "" && $_POST["password"] != "")
	{
		if (!isset($_SESSION["attempts"]))
		{
			$_SESSION["attempts"] = 0;
			$_SESSION["blocklist"] = '';
		}
	
		if ($_SESSION["blocklist"] != $_POST["email"] && $_SESSION["attempts"] < 3)
		{
			$username = $_POST["email"];
			$pass = $_POST["password"];
			$status = 'active';
			$lgnQry = $pdodb->prepare("SELECT * FROM nrna_members WHERE email=:username AND password=:pass AND mem_status=:status");
			$lgnQry->bindParam("username", $username, PDO::PARAM_STR);
			$lgnQry->bindParam("pass", $pass, PDO::PARAM_STR);
			$lgnQry->bindParam("status", $status, PDO::PARAM_STR);
			$lgnQry->execute();
			$count = $lgnQry->rowCount();
			if ($count > 0)
			{
				$data = $lgnQry->fetch(PDO::FETCH_OBJ);
				$_SESSION['user_id'] = $data->member_id;
				$_SESSION['user_name'] = $data->member_name;
                                $_SESSION['txn_id'] = $data->txn_id;
                                $_SESSION['mem_img'] = $data->mem_image;
				header("Location: dashboard.php");
				exit;
			}
			else
			{
				$err_msg = $helper_msg['login_err'];
				$_SESSION["attempts"] = $_SESSION["attempts"] + 1;
			}
		}
		else
		{
			$_SESSION["blocklist"] = $_POST["email"];
			$err_msg = "You've failed too many times, Try after 30 minutes.";
		}
	}


	// Password recovery form
	if (isset($_POST["pwd_reset"], $_POST["useremail"]) && $_POST["useremail"] != "")
	{
		// User availability Check
		$check3 = userAvailable($pdodb, $_POST["useremail"]);
		if ($check3 == 1)
		{
			$token = tokenGeneration();
			$pwdUpdQry = $pdodb->prepare("UPDATE nrna_members SET password=? WHERE email = ? ");
			$data = array(
				$token,
				$_POST["useremail"]
			);
			$upd1 = $pwdUpdQry->execute($data);
			if ($upd1)
			{
				passwordRecovery_mail($_POST["useremail"], $token);
				$succ_msg = $helper_msg['reset_mail_succ'];
			}
		}
		else
		{
			$err_msg = $helper_msg['reset_err'];
		}
	}

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
	<style type="text/css">
		.alert{ display:none; }
	</style>   
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
      <div id="main-wrapper" class="login-wrapper">

        <div class="cotn_principal">
          <div class="alert alert-success" style="<?php if(isset($succ_msg) && $succ_msg !=''){ ?> margin: 10px; display:block; <?php } ?>">  <span class="succ"> <?php echo $succ_msg; ?></span>
          </div>
          <div class="alert alert-danger" style="<?php if(isset($err_msg) && $err_msg !=''){ ?> margin: 10px; display:block;<?php } ?>"><span> <?php echo $err_msg; ?></span>
          </div>
          <div id="google_translate_element" style="margin: 10px; float: right;"></div>
          <form role="form" class="loginForm" name="loginForm" id="loginForm" action="" method="post" autocomplete="off">
            <div id="msform">
               <!-- fieldsets -->
               <fieldset style="position: relative;">
                 <h2 class="fs-title">Welcome to NRNA</h2>
                 <input type="text" id="email" name="email" placeholder="Email *" value="" autocomplete="off" />
                 <input type="password" id="password" name="password" value="" placeholder="Password *" autocomplete="off" /><br>
                 <input type="submit" name="login" id="login" class="action-button" value="Submit" />
                 <p class="">
                   <small>Do not have an account? <a href="index.php">Signup Now</a></small>
                 </p>
                 <p class="frgpwd"><a href="javascript:;" onclick="formToggle('reset-form');"> <small>Having trouble logging in?</small> </a></p>
               </fieldset>
<?php //include "footer.php"; ?>
            </div>
          </form>

          <form class="m-t index-forms reset-form" raccept-charset="UTF-8" role="form" name="pwdreset" id="resetform" action="" method="post" autocomplete="off" style="display: none;">
            <div id="msform">
               <!-- fieldsets -->
               <fieldset style="position: relative;">
                 <h2 class="fs-title">Password Recovery</h2>
                 <input type="text" name="useremail" id="useremail" placeholder="Email *" value="" autocomplete="off"><br>
                 <input type="submit" name="pwd_reset" id="pwd_reset" class="action-button" value="Submit" />
                 <p class="">
                   <small><a href="javascript:;" onclick="formToggle('loginForm');">Login Now</a></small>
                 </p>
               </fieldset>
            </div>
          </form>

        </div>
<?php include "footer.php"; ?>

      </div>
   </body>
</html>


<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- JQuery Validation Plugin -->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/validation-methods.js" type="text/javascript"></script>

<script type="text/javascript">
/********** functions ********/
function formToggle(formClass) {
    $("form").hide("slow");
    $("." + formClass).slideDown();
}

$(document).ready(function() {

	 $(".se-pre-con").fadeOut("slow");

    $('#loginForm').validate({
        rules: {
            email: {
                required: true
            },
            password: {
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
        /*submitHandler: function(form) { // <- only fires when form is valid
            //document.loginForm.submit();
        }*/
    });


    $('#resetform').validate({
        rules: {
            useremail: {
                required: true,
				email: true
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        /*success: function (element) {
         element.text('').addClass('valid')
           .closest('.form-group').removeClass('has-error').addClass('has-success');
        },*/
        /*submitHandler: function(form) { // <- only fires when form is valid
            //document.loginForm.submit();
        }*/
    });




}); /* $(document) close */

</script>



<style>  
#msform{ margin: 50px auto 50px !important; }
.cotn_principal{ padding-bottom: 50px; }
#msform fieldset{ position: relative; }
</style>