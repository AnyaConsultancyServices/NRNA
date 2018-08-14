<?php
    // PayPal Url - Sandbox
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
    $busId = 'treasury.nrnauk-facilitator@gmail.com';

    // PayPal Url - Live
    /*    
        $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     
        $busId = 'treasury.nrnauk@gmail.com';	
    */


/* insert details into database  `payment` table with payment pending status */
    
    $last_insert_id = 1; //temprory


         $amount = 1;
         $firstName = 'Venkatesan';
          $lastName = 'Loganathan';
             $email = 'venkatesanl@anyaconsultancy.com';
?>

<form action="<?php echo $paypal_url; ?>" method="post" name="nrnaForm">

    <input type="hidden" name="business" value="<?php echo $busId; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="NRNA-UK">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="hidden" name="first_name" value="<?php echo $firstName; ?>">
    <input type="hidden" name="last_name" value="<?php echo $lastName; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type='hidden' name='notify_url' value='http://nrna.co.uk/dev/pp_notify.php'>
    <input type='hidden' name='cancel_return' value='http://nrna.co.uk/dev/pp_cancel.php?cid=<?php echo $last_insert_id; ?>'>
    <input type='hidden' name='return' value='http://nrna.co.uk/dev/payment_success.php'>

</form>

<script>
	document.nrnaForm.submit();
</script>

<?php 


?>