<?php 
	include("./library/db_config.php");
	include('./library/loginfunctions.php');


	if(isset($_POST["login"]))
	{
		$email = $_POST["email"];
		$pass = $_POST["password"]; 

		$query = "SELECT * FROM nrna_members WHERE email = '".$email."' AND password = '".$pass."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0) {
		
			$user = mysql_fetch_array($result);
			
			$_SESSION['adminid'] = $user['member_id'];

			// Set cookies too
			setcookie('email', $email, time() + 60 * 60 * 24 * 30);
			setcookie('password', $pass, time() + 60 * 60 * 24 * 30);
									
			redirect('landing_page.php');
			exit();
				
		} else { $badlogin = true; }
	}	


	if(isset($_POST["register"])){  
	
		$fullname = $_POST["fullname"];
		$email = $_POST["email"];
		$password = $_POST["password"];	
		$phone = $_POST["phone"];
		$dateofbirth = $_POST["dob"];
		$ukaddress = mysql_real_escape_string($_POST["ukaddress"]);
		$nepaladdress = mysql_real_escape_string($_POST["nepaladdress"]);
				
		$Query = mysql_query("INSERT INTO nrna_members
							(`member_id`, `member_name`, `email`, `password`, `phone`, `dob`, `uk_address`, `nepal_address`, `member_since`)
							VALUES ('', '$fullname', '$email', '$password', '$phone', '$dateofbirth', '$ukaddress', '$nepaladdress', now())");
	
		if($Query) {
		
			$_SESSION['member_id'] = mysql_insert_id();
			
			echo "<h4>Member Registered successfully</h4>";
			
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
      <link rel="stylesheet" href="css/style.css">
      <!--Google Fonts-->
      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <div id="main-wrapper">
         <div class="cotn_principal">
            <div class="cont_centrar">
               <div class="cont_login">
                  <div class="cont_info_log_sign_up">
                     <div class="col_md_login">
                        <div class="cont_ba_opcitiy">
                           <h2>LOGIN</h2>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                           <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
                        </div>
                     </div>
                     <div class="col_md_sign_up">
                        <div class="cont_ba_opcitiy">
                           <h2>SIGN UP</h2>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                           <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
                        </div>
                     </div>
                  </div>
                  <div class="cont_back_info">
                     <div class="cont_img_back_grey">
                        <img src="img/login-bg.jpg" alt="" />
                     </div>
                  </div>
                  <div class="cont_forms" >
                     <div class="cont_img_back_">
                        <img src="img/login-bg.jpg" alt="" />
                     </div>

					<form role="form" name="loginForm" id="loginForm" action="" method="post">
					 <div class="cont_form_login">
						<a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
						<h2>LOGIN</h2>
						<input name="email" class="form-control" placeholder="Email" id="email" type="text" value="" />
						<input name="password" class="form-control" placeholder="Password" id="password" value="" type="password" />
						<button type="submit" name="login" class="btn_login" onclick="cambiar_login()">LOGIN</button>
					 </div>
                    </form>

                    <form role="form" name="signupForm" id="signupForm" action="" method="post">
					 <div class="cont_form_sign_up">
						<a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
						  <input type="text" id="fullname" name="fullname" placeholder="Full Name" value="" />
						  <input type="text" id="email" name="email" placeholder="Email" value="" />
						  <input type="password" id="password" name="password" value="" placeholder="Password" />
						  <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" />
						  <input type="text" id="phone" name="phone" value="" placeholder="Contact Number" />
						  <input type="text" id="dob" name="dob" placeholder="Date of Birth" value="" />
						  <input type="text" id="ukaddress" name="ukaddress" placeholder="UK Address" value="" />
						  <input type="text" id="nepaladdress" name="nepaladdress" placeholder="Nepal Address" value="" />
						  <button type="submit" name="register" class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
					 </div>
                    </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end #main-wrapper -->
   </body>
</html>


<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script src="js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="js/validation-methods.js" type="text/javascript"></script>


<script type="text/javascript">
   function cambiar_login() {
       document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";
       document.querySelector('.cont_form_login').style.display = "block";
       document.querySelector('.cont_form_sign_up').style.opacity = "0";

       setTimeout(function() {
           document.querySelector('.cont_form_login').style.opacity = "1";
       }, 400);

       setTimeout(function() {
           document.querySelector('.cont_form_sign_up').style.display = "none";
       }, 200);
   }

   function cambiar_sign_up(at) {
       document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
       document.querySelector('.cont_form_sign_up').style.display = "block";
       document.querySelector('.cont_form_login').style.opacity = "0";

       setTimeout(function() {
           document.querySelector('.cont_form_sign_up').style.opacity = "1";
       }, 100);

       setTimeout(function() {
           document.querySelector('.cont_form_login').style.display = "none";
       }, 400);
   }

   function ocultar_login_sign_up() {

       document.querySelector('.cont_forms').className = "cont_forms";
       document.querySelector('.cont_form_sign_up').style.opacity = "0";
       document.querySelector('.cont_form_login').style.opacity = "0";

       setTimeout(function() {
           document.querySelector('.cont_form_sign_up').style.display = "none";
           document.querySelector('.cont_form_login').style.display = "none";
       }, 500);
   }




$(document).ready(function() {

    $('#user-signup').validate({
        rules: {
            fullname: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            phone: {
                required: true
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
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        /*success: function (element) {
         element.text('').addClass('valid')
           .closest('.form-group').removeClass('has-error').addClass('has-success');
        },*/
        submitHandler: function(form) { // <- only fires when form is valid

			document.signupForm.submit();

        }
    });


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
        submitHandler: function(form) { // <- only fires when form is valid

			document.loginForm.submit();

        }
    });


});

</script>

