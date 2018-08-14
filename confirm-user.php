<?php
$succ_msg = $err_msg = '';
include 'library/db_config.php';

include ("library/loginfunctions.php");

include ("library/emails.php");

// include 'library/user_controller.php';
// Conforming the email address and account activation
if(!isset($_GET["child"])){
if (isset($_GET["u"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "user-confirm")
{

  // User availability Check

  $email = $_GET["em"];
  $uid = $_GET["u"];
  $stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending'");
  $data = array(
    $email,
    $uid
  );
  $stmt->execute($data);
  $count = $stmt->rowCount();
  if ($count == 1)
  {
    $updQry = $pdodb->prepare("UPDATE nrna_members SET mem_status='active' WHERE MD5(email) = ? AND MD5(member_id) = ? AND mem_status = 'pending' ");
    $data = array(
      $email,
      $uid
    );
    $upd = $updQry->execute($data);
    if ($upd)
    {
      $succ_msg = "<h2>Your account has been verified</h2>
            Please <a href='login.php'><strong>Login</strong></a> to continue";
    }
    else
    {
      $err_msg = "<h2>Email address not verified</h2> Unable verify your account, Please try again.";
    }
  }
  else
  {
    $err_msg = "<h2>Email address not verified</h2>
            We're sorry, the email address verification link you've submitted is invalid, expired or has already been used. Go to <a href='login.php'><strong>Login</strong></a>";
  }
}
}else{

  if (isset($_GET["u"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "user-confirm")
  {
  
    // User availability Check
  
    $email = $_GET["em"];
    $uid = $_GET["u"];
  
    $stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE  MD5(created_by) = ?  AND email_type='No Emails'");
    $data = array(
      $uid
    );
    $stmt->execute($data);
    echo $count = $stmt->rowCount();
    if ($count > 0)
    {
      $updQry = $pdodb->prepare("UPDATE nrna_members SET mem_status='active' WHERE  MD5(created_by) = ?  AND email_type='No Emails' ");
      $data = array(
        $uid
      );
      $upd = $updQry->execute($data);
      if ($upd)
      {
        $succ_msg = "<h2>Your account has been verified</h2>
              Please <a href='login.php'><strong>Login</strong></a> to continue";
      }
      else
      {
        $err_msg = "<h2>Email address not verified</h2> Unable verify your account, Please try again.";
      }
    }
    else
    {
      $err_msg = "<h2>Email address not verified</h2>
              We're sorry, the email address verification link you've submitted is invalid, expired or has already been used. Go to <a href='login.php'><strong>Login</strong></a>";
    }
  }
  
}

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Non Resident Nepali Association</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="css/login.css" rel="stylesheet">
   </head>
  <style type="text/css">
    .alert{ display:none; }
  </style>   
   <body class="gray-bg login-container user-confirm">
      <img src="img/nrna-logo.jpg" width="100" height="100">
      <div class="alert alert-success" style="<?php if(isset($succ_msg) && $succ_msg !=''){ ?>margin: 10px; display:block;<?php } ?>">  <span class="succ"> <?php echo $succ_msg; ?></span>
      </div>
      <div class="alert alert-danger" style="<?php if(isset($err_msg) && $err_msg !=''){ ?>margin: 10px; display:block;<?php } ?>"><span> <?php echo $err_msg; ?></span>
      </div>
      <div class="index-footer">
      </div>
   </body>
</html>