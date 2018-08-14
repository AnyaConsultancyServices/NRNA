<?php

// Signup email confirmation
function signupConfirm($params){
 
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $params['email'];
 		$data['sub'] = 'NRNA Account Confirmation';

 		$cnfUrl = BASE_PATH."/confirm-user.php?u=".md5($params['user_id'])."&em=".md5($params['email'])."&q=user-confirm";

 		$name = ($params['name']=='')?'User':$params['name'];

 		$data['body'] = "<h3>Welcome to Non Resident Nepali Association.</h3>
						<p>Thanks for registering with us, </p>
						<p>Username: '".$params['email']."'</p><br>
						<p>Password: '".$params['password']."'</p><br>
						<p>You are one step away from completing your account registration.</p>
						<p>Please confirm your account through the link below: </p><br>
						<a style='padding: 10px 22px; background: #387c96; color: #FFF; text-align: center; text-decoration: none;' href='".$cnfUrl."' target='blank'>Confirm My Account</a></p> <br><br><br>";

 		$mail1 = sendEmail($data);

}

function passwordRecovery_mail($email,$token){
 
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $email;
 		$data['sub'] = 'NRNA - Password Recovery';

 		$resetUrl = BASE_PATH."/pwd-reset.php?tk=".$token."&em=".md5($email)."&q=pwd-reset";

 		$data['body'] = "Dear User,
						 <p>Please reset your password through the link below:</p><br>
						 <a style='padding: 10px 22px; background: #387c96; color: #FFF; text-align: center; text-decoration: none;' href='".$resetUrl."' target='blank'>Reset My Password</a><br><br><br>";

 		$mail1 = sendEmail($data);
}

function passwordRecovery_acknowledge($email){
 
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $email;
 		$data['sub'] = 'NRNA - Password Reset Confirmation';

 		$data['body'] = "Dear User,
						 <p>Your password has been changed.</p><br>
						 <a style='padding: 10px 22px; background: #387c96; color: #FFF; text-align: center; text-decoration: none;' href='".BASE_PATH."' target='blank'>Login into my account</a><br><br><br>";

 		$mail1 = sendEmail($data);
}


function email_layout(){

		$hdr = array('
				<table cellspacing="0" cellpadding="0" style="width:100%;border:1px solid #cccccc;border-collapse:collapse;background: #f1f4f5;">
				 <tbody>
					<tr>
					<td style="text-align: center;"><img src="'.BASE_PATH.'/img/nrna-logo.jpg" style="width: 10%; margin: 0px auto -12px !important;"></td>
					</tr>
					<tr>
						<td valign="top" style="padding:16px">

							<table cellspacing="0" cellpadding="0" style="width: 95%;margin: 0 auto;">
								<tbody>
									<tr>
										<td style="font:12px tahoma,verdana,sans-serif" align="left">
										  <div style="color:black;background: #FFF;border: 1px solid #ccc;border-radius: 7px;padding: 30px 15px;">',
									'     </div>
										<p><center>Non Resident Nepali Association</center></p>
										<p><center>** Floor, ** Woodberry Grove, Finchley, London, United Kingdom.</center></p>
										<br>
										</td>
									</tr>
							    </tbody>
							</table>
						</td>
					</tr>
				 </tbody>
				</table>');
		return $hdr;

}


function sendEmail($params){

		$layout = email_layout();

		$sub = $params['sub'];
		$from = $params['from'];
		$to = $params['to']; 
		//$to = 'praveen.webtest@gmail.com';
		$body = $layout[0].$params['body'].$layout[1];
		$headers = "From: $from\n";
		$headers .= "MIME-Version:1.0\n";
		$headers .= "Content-type: text/html \n";
		$mailto = mail($to,$sub,$body,$headers);

		return $mailto;
}


?>