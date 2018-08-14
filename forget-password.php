<?php include 'library/user_controller.php'; ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title></title>
      <!-- Stylesheets -->
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!--Google Fonts-->
      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <div id="main-wrapper">
         <div class="cotn_principal">
            <form class="m-t index-forms reset-form" raccept-charset="UTF-8" role="form" name="pwdreset" id="resetform" action="" method="post" autocomplete="off">
               <div id="msform">
                  <!-- fieldsets -->
                  <fieldset style="position: relative;">
                     <h2 class="fs-title">Password Recovery</h2>
                     <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
                     <button type="submit" class="btn btn-primary m-b" name="pwd_reset">Submit</button>

                     <p class="">
                        <small>Alreadyave an account?  </br><a href="index.php">Login Now</a></small>
                     </p>                      
                  </fieldset>
               </div>
            </form>
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
          /*submitHandler: function(form) { // <- only fires when form is valid
              //document.loginForm.submit();
          }*/
      });

  }); /* $(document) close */

</script>

