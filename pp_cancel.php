<!DOCTYPE html>
<html >
<head>

  <meta charset="UTF-8">
  <title>Payment Cancelled</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'> 
   
</head>

<body>
<?php 

if(isset($_REQUEST['cid']) && $_REQUEST['cid'] !=''){

	/* update payment status as 'cancelled' in database  */
}

?>
<div class="title" style="text-align: center; border: 2px solid #FFF; padding: 25px 0; width: 50%; margin: 10% auto; background: #FFF;">

	<!-- <img src="logo.png" style="width: 35%; margin: 0 0 30px;"> -->

	<h3>Your payment has been cancelled. <!-- <br><br> <a href="index.php"> Go to ticket page </a>  --> </h3>
</div>


</body>
</html>