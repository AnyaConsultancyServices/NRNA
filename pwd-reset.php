<?php 

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $uemail = ''; $succ_msg = $err_msg = '';

    include ('library/db_config.php');
    include ("library/loginfunctions.php");
    include ("library/emails.php");

  //Password recovery form
  if(isset($_POST["pwd_recovery"], $_POST["newpass"]) && $_POST["newpass"] != ""){ 

    if($_POST["newpass"] == $_POST["confpass"]){

      $email = $_POST["em"]; $tk = $_POST["tk"];

      $stmt = $pdodb->prepare("SELECT email FROM nrna_members WHERE MD5(email) = ? AND password = ?"); 
      $data = array($email, $tk);
      $stmt->execute($data);

      $count = $stmt->rowCount();

      if($count > 0){

        $userdata = $stmt->fetch(PDO::FETCH_OBJ);

        $password = $_POST["newpass"];

            $updQry1 = $pdodb->prepare("UPDATE nrna_members SET password = ? WHERE MD5(email) = ?");
            $data = array($password, $email);
            $upd1 = $updQry1->execute($data);

            if($upd1){ 

              passwordRecovery_acknowledge($email);

              $succ_msg = $helper_msg['pwdreset_succ']; 

              $uemail = '';

            }else{ $err_msg = $helper_msg['userconfirm_err2']; }

      }else{ $err_msg = $helper_msg['pwd_reset_invalid']; }

    }else{ $err_msg = $helper_msg['password_mismatch']; }
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
   <style type="text/css">
      .alert{ display:none; }
   </style>
   <body>
      <div id="main-wrapper">
         <div class="cotn_principal">
            <div class="alert alert-success" style="<?php if(isset($succ_msg) && $succ_msg !=''){ ?> margin: 10px; display:block; <?php } ?>">  <span class="succ"> <?php echo $succ_msg; ?></span>
            </div>
            <div class="alert alert-danger" style="<?php if(isset($err_msg) && $err_msg !=''){ ?> margin: 10px; display:block;<?php } ?>"><span> <?php echo $err_msg; ?></span>
            </div>
            <?php if(isset($_GET["tk"], $_GET["em"], $_GET["q"]) && $_GET["q"] == "pwd-reset"){ ?>
            <form role="form" method="post" id="pwd_recovery_form" name="pwd_recovery_form">
               <div id="msform">
                  <!-- fieldsets -->
                  <fieldset style="position: relative;">
                     <h2 class="fs-title">Reset Your Password</h2>
                     <div class="form-group">
                        <input type="password" class="form-control" name="newpass" id="newpass" required="" placeholder="Enter New Password">
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="confpass" id="confpass" required="" placeholder="Confirm Your Password">
                     </div>
                     <div>
                        <input type="hidden" name="em" value="<?php echo $_GET["em"]; ?>">
                        <input type="hidden" name="tk" value="<?php echo $_GET["tk"]; ?>">
                        <button class="action-button" type="submit" name="pwd_recovery"><strong>Reset</strong></button>
                     </div>
                  </fieldset>
               </div>
            </form>
            <?php } ?>
         </div>
      </div>
      <!-- end #main-wrapper -->
   </body>
</html>

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- JQuery Validation Plugin -->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/validation-methods.js" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function() {

      $('#pwd_recovery_form').validate({
          rules: {
              newpass: {
                  required: true
              },
              confpass: {
                  required: true,
                  equalTo: "#newpass"
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

