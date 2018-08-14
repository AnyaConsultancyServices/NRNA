<?php
   require("library/db_config.php");
   include("library/loginheader.php"); 
?>
<style>
.person_image, .signature_image {
    margin: 20px 0;
    height: 149px;
}
.image-uploads {
    width: 30%;
    float: left;
}
</style>
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
				<div class="alert alert-success" style="margin: 10px; display: none;">
               <strong>Success!</strong> Image Uploaded Successfully
            </div>
                  <!-- fieldsets -->
                  <fieldset>
					<a href="logout.php" class="btn-sm btn-primary pull-right">Logout</a>
					<a href="#" class="btn-sm btn-primary pull-left" data-toggle="modal" data-target="#exampleModal">Update Password</a>
                     <h1 class="fs-title">Welcome to NRNA</h1>
                     <p class="">
                        Hi <?php echo $_SESSION['user_name']; ?>,</br></br> <img src="img/nrna-logo.jpg" width="100" height="100"></br></br>

                        You are successfully registered with us.</br></br>
                        <strong>Our online portal is under construction.</strong>
                     </p>  
<!--<p style="margin: 5px 0;"><a href="create-id.php?id=<?php echo $_SESSION['user_id']; ?>" class="btn-sm btn-primary" target="_blank">Download ID Card</a></p> -->
  
<?php if($_SESSION['txn_id']!=''):
?>
                      <p style="text-align:right;padding-right: 21px;font-weight: 700;"><a href="http://nrna.co.uk/pdfs/generate/order.php?cnt=<?php echo $_SESSION['txn_id']; ?>" target="_blank">Download Invoice</a></strong>
                     </p>
<?php endif;
?>      
<div class="image-uploads">
<div class="person_image"><img src="<?php echo $_SESSION['mem_img'] ?>" width="150" /></div>  
<div class="upload-btn-wrapper">
                        <button class="btn-sm btn-primary">Upload your Photo * <span class="pass-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>
                        <input type="file" name="personimg" id="passprtimg" />
                     </div> 
                     </div>
                     <div class="image-uploads">
                     <div class="signature_image"><img src="<?php echo $_SESSION['signature_img'] ?>" width="150" height="149" /></div>  
<div class="upload-btn-wrapper">
                        <button class="btn-sm btn-primary">Upload your Signature * <span class="signature-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>
                        <input type="file" name="signatureimg" id="signatureimg" />
                     </div> 
                     
                     </div> 
                     
                  </fieldset>
<?php include "footer.php"; ?>

               </div>
         </div>

      </div>
      <!-- end #main-wrapper -->

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel"><strong>Create New Password</strong></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">

			<form role="form" name="password-form" id="password-form" action="" method="post">
				<input type="hidden" name="user_passid" id="user_passid" value="<?php echo $_SESSION['user_id']; ?>" />
				<div class="form-group">
					<label>Old Password</label>
					<input type="password" name="oldpassword" id="oldpassword" class="form-control" value="">
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input type="password" name="newpassword" id="newpassword" class="form-control" value="">
				</div>
				<div class="form-group">
					<label>Re-Type New Password</label>
					<input type="password" name="retype_password" id="retype_password" class="form-control" value="">
				</div>
				<button type="submit" class="btn btn-default pull-right" style="width:100px; padding: 5px;">Update</button>
				<button class="btn btn-green pull-left" style="width:100px; padding: 5px;">Cancel</button>
			</form></br></br>

		  </div>
		</div>
	  </div>

	</div>

   </body>
</html>

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/validation-methods.js" type="text/javascript"></script>

<script type="text/javascript">
   $(document).ready(function() {

       $('#password-form').validate({
           rules: {
               oldpassword: {
                   required: true
               },
               newpassword: {
                   required: true
               },
               retype_password: {
                   required: true,
				   equalTo: "#newpassword"
               },
           },
           highlight: function(element) {
               $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
           },
           /*success: function (element) {
           	element.text('').addClass('valid')
           		.closest('.form-group').removeClass('has-error').addClass('has-success');
           },*/
           submitHandler: function(form) { // <- only fires when form is valid

               var userid = $("#user_passid").val();
               var oldpassword = $("#oldpassword").val();
			   var newpassword = $("#newpassword").val();

               $.post(
                   "./library/user_controller.php", {
	                   "action": 'updatepass',
                       "userid": userid,
                       "oldpassword": oldpassword,
					   "newpassword": newpassword
                   },
                   function(data) {
					 location.reload();
                   }
               );
           }
       });


 var imagefiles;
var signaturefiles;
      $('#passprtimg').on('change', preparePhotoUpload);

      function preparePhotoUpload(event) {

          $('.pass-uploaded').css('display', '-webkit-inline-box');

          imagefiles = event.target.files;
uploadimage();
      }

function uploadimage() {

          var data = new FormData();

          //adding file content to data
          $.each(imagefiles, function(key, value) {
              console.log(value);
               data.append("action", "uploadProfile");
              data.append("profileimg", value);


          });

          $.ajax({
              url: 'library/user_controller.php?files',
              type: 'POST',
              data: data,
              cache: false,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(data) {
                  window.location.reload();
                  console.log('After Results',data['2']);
                //  $("#addMemberForm").submit();
                  //$(".se-pre-con").fadeOut("slow");
if(data['2']=='Success'){
                  $(".alert-success").slideDown("slow");
}
              }
          });
      }
      
      
      
      $('#signatureimg').on('change', prepareSignatureUpload);

      function prepareSignatureUpload(event) {
          $('.signature-uploaded').css('display', '-webkit-inline-box');

          signaturefiles = event.target.files;
         uploadsignature();
      }

function uploadsignature() {

          var data = new FormData();

          //adding file content to data
          $.each(signaturefiles, function(key, value) {
              console.log(value);
               data.append("action", "uploadSignature");
              data.append("signatureimg", value);


          });

          $.ajax({
              url: 'library/user_controller.php?files',
              type: 'POST',
              data: data,
              cache: false,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(data) {
                  window.location.reload();
                  console.log('After Results',data['2']);
                //  $("#addMemberForm").submit();
                  //$(".se-pre-con").fadeOut("slow");
if(data['2']=='Success'){
                  $(".alert-success").slideDown("slow");
}
              }
          });
      }
      

   });

</script>
