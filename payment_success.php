<?php 
include ("library/db_config.php");

include ("library/loginfunctions.php");

include ("library/emails.php");

	$id = $_GET['item_number'];  
	$txn_id = $_GET['tx'];
	$payment_gross = $_GET['amt'];
	$currency_code = $_GET['cc'];
	$payment_status = $_GET['st'];
		
	// check whether the payment_status is Completed
	$isPaymentCompleted = false;
	if($payment_status == "Completed") {
		$isPaymentCompleted = true;
	}
	// check that txn_id has not been previously processed
	$isUniqueTxnId = false; 

		$stmt = $pdodb->prepare("SELECT * FROM nrna_members WHERE txn_id = ?");
		$data = array($txn_id);
		$stmt->execute($data);
		$count = $stmt->rowCount();

               $stmt2 = $pdodb->prepare("SELECT * FROM nrna_members WHERE member_id = ?");
		$data2 = array($id);
		$stmt2->execute($data2);
		$count2 = $stmt2->rowCount();
     $usersdata = $stmt2->fetchAll();
                $members = $pdodb->prepare("SELECT * FROM nrna_members WHERE created_by = ?");
		$datamember = array($id);
		$members->execute($datamember);
         $result = $members->fetchAll();
		$countmember = $members->rowCount();
$posts[] = $usersdata[0]['member_name']; 
$paidfor .= $usersdata[0]['member_name'].', ';
$sendto = $usersdata[0]['email'];
$sndphone = $usersdata[0]['phone'];
     foreach($result AS $row) {
    $posts[] = $row['member_name'];
   $paidfor .= $row['member_name'].', ';
}
$quantity = count($posts);  
	if($count == 0) {
        $isUniqueTxnId = true;
	}	
$tday = date('y-m-d');
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	if($isPaymentCompleted && $isUniqueTxnId && $payment_gross == $_SESSION['pay_amount'] && $currency_code == "GBP") {

		$updQry = $pdodb->prepare("UPDATE nrna_members SET paid_amount = ?, payment_status = ?, txn_id = ? WHERE member_id = ?");
		$data = array($payment_gross, $payment_status, $txn_id, $id);
		$upd = $updQry->execute($data);

		/*** Send Confirmation email to members***/
		signupConfirm($_SESSION['emailArr']);

   $familymebers = $pdodb->prepare("SELECT * FROM `nrna_members` WHERE created_by = '".$id."' AND email_type='No Emails'");
    $familymebers->execute();
while ($familyrow = $familymebers->fetch(PDO::FETCH_ASSOC)) { 
         $paremtparams[] = array(       'user_id' => $familyrow['member_id'],
					'email' => $familyrow['email'],
'name' => $familyrow['member_name'],
					'password' => $familyrow['password']
				);
}
//print_r($paremtparams);

signuParents($paremtparams, $sendto, $id);


$pdodb->query('INSERT INTO orders (`mem_id`, `amount`, `sub_total`, `tnx_id`, `payment_date`, `payment_method`, `status`, `create_time`) VALUES ("' . $id . '", "' . $payment_gross . '", "' . $payment_gross . '", "' . $txn_id . '", "' . $tday . '", "Paypal", "' . $payment_status . '", now())');
$lid = $pdodb->lastInsertId();
$orderid = '#Order_'.$lid;
$updQry = $pdodb->prepare("UPDATE orders SET order_id = ? WHERE id = ?");
		$data = array('#Order_'.$lid, $lid);
		$upd = $updQry->execute($data);
                    

 
         //paymentConfirm($paidfor, $payment_gross, $quantity, $sendto, $sndphone, $orderid );
		 paymentConfirmto($paidfor, $payment_gross, $quantity, $sendto, $sndphone, $orderid, $result, $usersdata );

	}

function paymentConfirmto($paidfor, $amount, $quntty, $email, $phone, $orderid, $result, $usersdata){
if ($paidfor)
{
       
    
		$data = array();
 		$data['from'] = 'Non Resident Nepali Association<info@nrna.co.uk>';
 		$data['to'] = $email;
 		$data['sub'] = 'NRNA Payment Confirmation for - '.$orderid;

 		$data['body'] = '<h3>Thank You For Your Order</h3>
		<p>Your Payment has been received and is now being processed. Your order details are shown below for your
reference:</p>
		<table style="width:100%; border:1px solid #ccc"> <thead><tr style="width:100%; border:1px solid #ccc"><th style="border:1px solid #ccc; text-align:center; padding:5px;" width="10">Sno</th><th style="border:1px solid #ccc; text-align:center; padding:5px;" width="25">Name</th><th style="border:1px solid #ccc; text-align:center; padding:5px;" width="25">Voter/Non Voter</th> <th style="border:1px solid #ccc; text-align:center; padding:5px;" width="10">Price</th>

            </tr>

          </thead>

          <tbody><tr style="border:1px solid #ccc"><td style="border:1px solid #ccc; text-align:center; padding:5px;">1</td><td style="border:1px solid #ccc; text-align:center; padding:5px;">'.$usersdata[0]['member_name'].'</td><td style="border:1px solid #ccc; text-align:center; padding:5px;">'.$usersdata[0]['like_to_vote'].'</td><td style="border:1px solid #ccc; text-align:center; padding:5px;">£ 10.00</td></tr>';
		   $sno=2;
		   foreach($result AS $row) {
			   if($row['like_to_vote']=='Yes'):
$like_to_v = 'Voter';
			   $amt = '£ 10.00';
			   else:
$like_to_v = 'Non-voter';
			   $amt = '£ 05.00';
			   endif;
		 $data['body'] .= '<tr>

              <td style="border:1px solid #ccc; text-align:center; padding:5px;" width="10">' .$sno.'</td>

              <td style="border:1px solid #ccc; text-align:center; padding:5px;" width="25">'.$row['member_name'].'</td>
			  <td style="border:1px solid #ccc; text-align:center; padding:5px;" width="25">'.$like_to_v.'</td>
			  <td style="border:1px solid #ccc; text-align:center; padding:5px;" width="10">'.$amt.'</td>

         </tr>';
		 
		   $sno++;
		   }
		   $data['body'] .='<tr><td colspan="3" style="border:1px solid #ccc; text-align:right; padding:5px;"><b>Grand Total:</b> </td><td style="border:1px solid #ccc; text-align:center; padding:5px;">£ '.$amount.'</td></tr></tbody></table><h3>Thank You For Your Order</h3>
		<p> <strong>Email:</strong> '.$email.'</a><p/><p><strong>Phone:</strong> '.$phone.'</p>';

 		$mail1 = sendEmail($data);
	
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
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!--Google Fonts-->
      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <div id="main-wrapper">
         <div class="cotn_principal">
               <div id="msform" style="width: auto;">				
                  <!-- fieldsets -->
                  <fieldset>

                     <h1 class="fs-title">Welcome to NRNA</h1>
            <div class="alert alert-success" style="margin: 10px;">
               <strong>Success!</strong> We have sent confirmation link to your Email ID.
            </div>

                     <p class="">
                         <img src="img/nrna-logo.jpg" width="100" height="100"></br></br>
                        You are successfully registered with us.</br></br>
                        <strong>Our online portal is under construction.</strong>
                     </p> 
<?php if($txn_id!=''):
?>
                      <p style="text-align:right;padding-right: 21px;font-weight: 700;"><a href="http://nrna.co.uk/pdfs/generate/order.php?cnt=<?php echo $txn_id; ?>" target="_blank">Download Invoice</a></strong>
                     </p>
<?php endif;
?>                      
                  </fieldset>
               </div>
         </div>
      </div>
      <!-- end #main-wrapper -->

   </body>
</html>