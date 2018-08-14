<?php 

$id = $_GET['item_number'];  
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];

echo 'Transaction ID:'.$txn_id."<br>Payment Status: ".$payment_status;


/* Update the payment status into database as success */






?>

<br><br><br>

<center>
	<h3> your payment has been processed successfully </h3>
</center>