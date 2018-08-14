<?php
//include ("db_config.php");
// Signup email confirmation

function signuParents($all_params, $parent, $parent_id){
if($all_params){
$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $parent;
 		$data['sub'] = 'User details';
                $cnfUrl = BASE_PATH."/confirm-user.php?u=".md5($parent_id)."&em=".md5($parent)."&q=user-confirm&child=yes";
               

 		$data['body'] = "<h3>Welcome to Non Resident Nepali Association.</h3>
						<p>Thanks for registering with us, Please find you family members Login details </p>";
foreach ($all_params as $value)
{
				  $data['body'] .= "<p>Details For: '".$value['name']."'</p>
<p>Username: '".$value['email']."'</p>
						<p>Password: '".$value['password']."'</p><br>";

}

				$data['body'] .="<p>You are one step away from completing your account registration.</p>
						<p>Please confirm your account through the link below: </p><br>
						<a style='padding: 10px 22px; background: #387c96; color: #FFF; text-align: center; text-decoration: none;' href='".$cnfUrl."' target='blank'>Confirm My Account</a></p> <br><br><br>";

$mail1 = sendEmail($data);
}

}

function signupConfirm($params){

if (is_array($params) || is_object($params))
{


foreach ($params as $value)
    {
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $value['email'];
 		$data['sub'] = 'Thanks for your interest on NRNA';

 		$name = ($value['name']=='')?'User':$value['name'];

 		$data['body'] = "<h3>Hi '".$value['email']."'.</h3>
						<p>Thanks for your application. your registration is under process.</p>
						<p>Your documents hasbeen forwarded to the NRNA admin team for the review</p><br>
						<p>Thanks,</p>
						<p>NRNA Admin</p>";
						

 		$mail1 = sendEmail($data);
		}





    foreach ($params as $value)
    {
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $value['email'];
 		$data['sub'] = 'NRNA Account Confirmation';

 		$cnfUrl = BASE_PATH."/confirm-user.php?u=".md5($value['user_id'])."&em=".md5($value['email'])."&q=user-confirm";

 		$name = ($value['name']=='')?'User':$value['name'];

 		$data['body'] = "<h3>Welcome to Non Resident Nepali Association.</h3>
						<p>Thanks for registering with us, </p>
						<p>Username: '".$value['email']."'</p><br>
						<p>Password: '".$value['password']."'</p><br>
						<p>You are one step away from completing your account registration.</p>
						<p>Please confirm your account through the link below: </p><br>
						<a style='padding: 10px 22px; background: #387c96; color: #FFF; text-align: center; text-decoration: none;' href='".$cnfUrl."' target='blank'>Confirm My Account</a></p> <br><br><br>";

 		$mail1 = sendEmail($data);
		}
	}

}

function paymentConfirm($paidfor, $amount, $quntty, $email, $phone, $orderid){
if ($paidfor)
{
    
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $email;
 		$data['sub'] = 'Payment Confirmation for - '.$orderid;

 		$data['body'] = '<h3>Thank You For Your Order</h3>
		<p>Your Payment has been received and is now being processed. Your order details are shown below for your
reference:</p>
		<table> <thead><tr><th>Description</th><th>Quantity</th> <th>Price</th>

            </tr>

          </thead>

          <tbody>

            <tr>

              <td>Paid For:' .$paidfor.'</td>

              <td>'.$quntty.'</td>
			  <td>£ '.$amount.'</td>

         </tr>
		  <tr>

              <td>Sub total</td>

              <td> </td>
			  <td>£ '.$amount.'</td>

         </tr>
		 <tr>

              <td>total</td>

              <td> </td>
			  <td>£ '.$amount.'</td>

         </tr></tbody></table><h3>Thank You For Your Order</h3>
		<p> <strong>Email:</strong> '.$email.'</a><p/><p><strong>Phone:</strong> '.$phone.'</p>';

 		$mail1 = sendEmail($data);
	
	}

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
					<td style="text-align: center;"><img src="'.BASE_PATH.'/img/Logo-official.jpg" style="width: 70%;padding-top: 10px; margin: 0px auto -12px !important;"></td>
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