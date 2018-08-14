<?php

$helper_msg = array(

//Common Messages
'update_succ' 	=> 'Updated Successfully',
'update_err' 	=> 'Failed!, There is an error in Updating the details.',

//Sign in & Sign Up
'signup_succ' 	=> 'You account has been created successfully, 
				 	<br>Please check your email to confirm and activate your account',
'signup_err' 	=> 'Failed! There is an error in creating your account, Please try again',
'login_err'		=> 'Failed! Incorrect Username / Password. Please try again',
'reset_err'		=> 'Failed! There is no user found in our system with your given e-mail address',
'reset_mail_succ' => 'We have sent you the password reset link to your given email ID.<br>
					  Please check your email inbox.',
'pwd_reset_invalid' => "<h2>Invalid entry</h2>  The link has been expired or Invalid.
						Go to <a href='login.php'><strong>Home</strong></a>",
'password_mismatch'	=> '<h2>Password Mismatch!</h2>New password and Confirm password are not same',		
'pwdreset_succ' => "<h2>Password has been changed</h2>Please <a href='login.php'><strong>Login</strong></a> to continue",		
'user_exist' 	=> "Email address already used. Please try with different email address or <br>
				  <a href='login.php?q=pwd-recovery'><strong>Click here</strong></a> to reset your password.",
'userconfirm_err1' => "<h2>Email address not verified</h2>
					  We're sorry, the email address verification link you've submitted is invalid, expired or has already been used. Go to <a href='login.php'><strong>Login</strong></a>",
'userconfirm_err2' => "<h2>Email address not verified</h2> Unable verify your account, Please try again.",
'userconfirm_succ' => "<h2>Your account has been verified</h2>
						Please <a href='login.php'><strong>Login</strong></a> to continue",
'org_validate' => "Failed! Organisation name has not given",
'org_add_succ' => "New Organisation has been added successfully",
'prd_add_succ' => "New Product/Department added successfully",
'prd_add_err' => "Please fill all the necessary details",

//Goals CRUD


//User profile



// Product


//Organizastion




);


?>