<?php 
/****View Details Page***/
// PayPal Url - Sandbox
/*
   $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
   $busId = 'treasury.nrnauk-facilitator@gmail.com';
*/
   // PayPal Url - Live
       
       $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     
       $busId = 'treasury.nrnauk@gmail.com'; 
   
include('library/db_config.php');
if(isset($_GET['id'])):
$ids = $_GET['id'];
else:
header("Location: members.php");
endif;
    $result = $pdodb->prepare("SELECT * FROM `nrna_members` WHERE member_id = '".$ids."'");
    $result->execute();

  $familymebers = $pdodb->prepare("SELECT * FROM `nrna_members` WHERE created_by = '".$ids."'");
    $familymebers->execute();
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
      <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!--Google Fonts-->
      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

      <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
      </script>

      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

   </head>
   <body>
      <div class="se-pre-con"></div>
      <div class="inner nrna">
         <!-- wrapper of the page -->
         <div id="wrapper">
            <!-- header of the page -->
            <header id="header">
               <div class="top-header">
                  <div class="container">
                     <!-- logo -->
                     <div class="logo">
                        <h1>
                           <span class="sr-only">Non Resident Nepali Association</span>
                           <a id="dnn_dnnLOGO_hypLogo" title="NRNA" href="https://bw.nrna.org/"><img id="dnn_dnnLOGO_imgLogo" class="circle" src="./img/logo.png" alt="NRNA"></a>
                           <span class="slogan">
                           <img src="./img/slogan-text.png" alt="Non Resident Nepali Association">
                           </span>
                           <span class="ncc-name"> NRNA
                           </span>
                        </h1>
                     </div>
                  </div>
               </div>
            </header>
            <!-- main informative parts of page -->
            <main id="main">
               <div class="content-container container">
                  <!-- content of the page -->
                  <div id="content">
                     <!-- inner page article -->
                     <article class="page-article">
                        <div id="dnn_ContentPane" class="DNNEmptyPane"></div>
                     </article>
                  </div>
               </div>
            </main>
         </div>
      </div>

      <div id="main-wrapper">
             <div class="cotn_principal">
                <div class="alert alert-success" style="margin: 10px; display: none;">
                   <strong>Success!</strong> We have sent confirmation link to your Email ID.
                </div>
                <div id="google_translate_element" style="margin: 10px; float: right;"></div>
<div class="table-container col-md-12 col-sm-12">

                <table class="table">
                    <thead class="text-primary">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>UK Address</th>
<th>Passport</th>
<th>Nepal Address</th>
<th>Profession</th>
<th>Income</th>
<th>Annual Income</th>
<th>Passport</th>
<th>Address</th>
<th>Like to Vote?</th>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['member_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['dob']; ?></td>
                            <td><?php echo $row['uk_address']; ?></td>
                            <td><?php echo $row['passport_num']; ?></td>
                            <td><?php echo $row['nepal_address']; ?></td>
<td><?php echo $row['profession']; ?></td>
<td><?php echo $row['income']; ?></td>
<td><?php echo $row['income_others']; ?></td>
<td><img  style="width: 150px;" src="<?php echo $row['passport_img']; ?>" height="150" /></td>
<td><img  style="width: 150px;" src="<?php echo $row['address_proof']; ?>" height="150" /></td>
<td><?php echo $row['like_to_vote']; ?></td>
                        </tr>
                        <?php } ?>
                
                <?php while ($familyrow = $familymebers->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $familyrow['member_name']; ?></td>
                            <td><?php echo $familyrow['email']; ?></td>
                            <td><?php echo $familyrow['phone']; ?></td>
                            <td><?php echo $familyrow['dob']; ?></td>
                            <td><?php echo $familyrow['uk_address']; ?></td>
<td><?php echo $familyrow['passport_num']; ?></td>
                            <td><?php echo $familyrow['nepal_address']; ?></td>
<td><?php echo $familyrow['profession']; ?></td>
<td><?php echo $familyrow['income']; ?></td>
<td><?php echo $familyrow['income_others']; ?></td>
<td><img  style="width: 150px;" src="<?php echo $familyrow['passport_img']; ?>" height="150" /></td>
<td><img  style="width: 150px;" src="<?php echo $familyrow['address_proof']; ?>" height="150" /></td>
<td><?php if($familyrow['like_to_vote']!=''): echo $familyrow['like_to_vote']; else: echo "No"; endif; ?></td>
                        </tr>
                        <?php } ?>

<tr>
                            <td colspan="12">total</td><td><strong>£ <?php echo $_SESSION['pay_amount']; ?></strong></td>
                            
                     
                        </tr>
                    </tbody>
                </table>

<form action="<?php echo $paypal_url; ?>" method="post" name="nrnaForm">

    <input type="hidden" name="business" value="<?php echo $busId; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="NRNA-UK">
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $ids; ?>">
    <input type="hidden" name="amount" id="pay_amount" value="<?php echo $_SESSION['pay_amount']; ?>">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="hidden" name="first_name" id="pay_name" value="<?php echo $row['member_name']; ?>">
    <input type="hidden" name="email" id="pay_email" value="<?php echo $row['member_name']; ?>">
    <input type='hidden' name='notify_url' value='http://nrna.co.uk/pp_notify.php'>
    <input type='hidden' name='cancel_return' value='http://nrna.co.uk/pp_cancel.php'>
    <input type='hidden' name='return' value='http://nrna.co.uk/payment_success.php'>
<a href="index.php" class="btn action-button">Cancel</a>
<input type="submit" value="Pay now" class="btn action-button" /> 

</form>

</div>
                                      </div>
          </div>
</body>



<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JQuery Validation Plugin -->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/validation-methods.js" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function() { 
      $(window).keydown(function(event) {
          if (event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
      });
  });


  $(function() {

      $(".se-pre-con").fadeOut("slow");

      //$("#dob").datepicker({ dateFormat: 'dd-mm-yy' });

      var d = new Date(70,0,1);
      $(".datepicker").datepicker({
          defaultDate:d,
          dateFormat: 'dd-mm-yy',
          showButtonPanel: true,
          changeMonth: true,
          changeYear: true,
          yearRange: "1950:2030",
          showOtherMonths: true,
          selectOtherMonths: true
      });


      $("#insert-more").click(function() {
          $("#familytable").each(function() {
                var tds = '<tr><td><select name="mem_relation[]" required="required"><option value="">Select</option><option value="mother">Mother</option> <option value="father">Father</option><option value="sister">Sister</option><option value="brother">Brother</option><option value="wife">Wife</option> <option value="son">Son</option><option value="daughter">Daughter</option><option value="others">Others</option></select></td><td><input type="text" name="mem_name[]" value="" required="required" autocomplete="off"></td><td><input type="email" name="mem_email[]" value="" required="required" autocomplete="off"></td><td><input type="text" class="datepicker" name="mem_dob[]"  value="" required="required" autocomplete="off" ></td><td><input type="text" name="mem_passport[]" required="required" autocomplete="off"></td></tr>';
              if ($('tbody', this).length > 0) {
                  $('tbody', this).append(tds);
              } else {
                  $(this).append(tds).trigger("create");
              }
          });
var d = new Date(90,0,1);
                $(".datepicker").datepicker({
                    defaultDate:d,
                    dateFormat: 'dd-mm-yy',
                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1950:2030",
                    showOtherMonths: true,
                    selectOtherMonths: true,
                });
      });
  });


 /* function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test($email);
  }*/

  function checkAvailability() {

      //if (validateEmail($("#email").val())) {

          $("#loaderIcon").show();
          jQuery.ajax({
              url: "library/user_controller.php",
              data: 'checkuseremail=' + $("#email").val(),
              type: "POST",
              success: function(data) {
                  $("#email-availability-status").html(data);
                  $("#loaderIcon").hide();
              },
              error: function() {}
          });

      //}
  }
  $(document).ready(function() {

      $("#phone").focusout(function(e) {

          alert('We will send an OTP to the given number. '+e.target.value);

          if (e.target.value != '') {

              $(".se-pre-con").fadeIn("slow");

              var phnno = $("#contact_code").val() + $("#phone").val();

              if (phnno != '') {

                  jQuery.ajax({
                      url: "library/otp_controller.php",
                      data: 'phone=' + phnno,
                      type: "POST",
                      success: function(data) {
                          $('#OTPModal').modal('show');
                          $(".se-pre-con").fadeOut("slow");
                      },
                      error: function() {}
                  });
              }

          }

      });


      $('#OTPform').validate({
          rules: {
              otpvalue: {
                  required: true
              }
          },
          highlight: function(element) {
              $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
          },
          submitHandler: function(form) {

              $(".se-pre-con").fadeIn("slow");

              var otpval = $("#otpvalue").val();

              $.post(
                  "library/otp_controller.php", {
                      "otpvalue": otpval
                  },
                  function(data) {
                      //console.log(data);
                      $(".se-pre-con").fadeOut("slow");

                      if (data == 'success') {

                          $('#OTPModal').modal('hide');

                      } else {

                          $(".err-alt").css("display", "block");

                      }
                  }
              );
          }
      });
  });


  //jQuery time
  (function($) {
      var current_fs, next_fs, previous_fs; //fieldsets
      var left, opacity, scale; //fieldset properties which we will animate
      var animating; //flag to prevent quick multi-click glitches

      $(".next").click(function() {

          var signupForm = $("#signupForm");

          $('#signupForm').valid();
          console.log("Valid: " + signupForm.valid());

          if (signupForm.valid() === false) return false;

          if (animating) return false;
          animating = true;

          current_fs = $(this).parent();
          next_fs = $(this).parent().next();

          //activate next step on progressbar using the index of next_fs
          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

          //show the next fieldset
          next_fs.show();
          //hide the current fieldset with style
          current_fs.animate({
              opacity: 0
          }, {
              step: function(now, mx) {
                  //as the opacity of current_fs reduces to 0 - stored in "now"
                  //1. scale current_fs down to 80%
                  scale = 1 - (1 - now) * 0.2;
                  //2. bring next_fs from the right(50%)
                  left = (now * 50) + "%";
                  //3. increase opacity of next_fs to 1 as it moves in
                  opacity = 1 - now;
                  current_fs.css({
                      'transform': 'scale(' + scale + ')'
                  });
                  next_fs.css({
                      'left': left,
                      'opacity': opacity
                  });
              },
              duration: 800,
              complete: function() {
                  current_fs.hide();
                  animating = false;
              },
              //this comes from the custom easing plugin
              easing: 'easeInOutBack'
          });
      });

      $(".previous").click(function() {
          if (animating) return false;
          animating = true;

          current_fs = $(this).parent();
          previous_fs = $(this).parent().prev();

          //de-activate current step on progressbar
          $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

          //show the previous fieldset
          previous_fs.show();
          //hide the current fieldset with style
          current_fs.animate({
              opacity: 0
          }, {
              step: function(now, mx) {
                  //as the opacity of current_fs reduces to 0 - stored in "now"
                  //1. scale previous_fs from 80% to 100%
                  scale = 0.8 + (1 - now) * 0.2;
                  //2. take current_fs to the right(50%) - from 0%
                  left = ((1 - now) * 50) + "%";
                  //3. increase opacity of previous_fs to 1 as it moves in
                  opacity = 1 - now;
                  current_fs.css({
                      'left': left
                  });
                  previous_fs.css({
                      'transform': 'scale(' + scale + ')',
                      'opacity': opacity
                  });
              },
              duration: 800,
              complete: function() {
                  current_fs.hide();
                  animating = false;
              },
              //this comes from the custom easing plugin
              easing: 'easeInOutBack'
          });
      });
  })(jQuery);



  $(document).ready(function() {

      $('#signupForm').validate({
          rules: {
              fullname: {
                  required: true
              }, 
              lname: {
                  required: true
              },
              email: {
                  required: true,
                  email: true
              },
              password: {
                  required: true
              },
              confirm_password: {
                  required: true,
                  equalTo: "#password"
              },
              phone: {
                  required: true,
                  digits: true
              },
              dob: {
                  required: true
              },
              ukaddress: {
                  required: true
              },
              nepaladdress: {
                  required: true
              },
              passport_number: {
                  required: true
              },
              passprtimg: {
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
          submitHandler: function(form) { // <- only fires when form is valid

              //alert($('#fullname').val());
              //document.signupForm.submit();

              $(".se-pre-con").fadeIn("slow");

              var membername = $("#fullname").val();
              var lname      = $("#lname").val();
              var membremail = $("#email").val();
              var password = $("#password").val();
              var phonenum = $("#phone").val();
              var dateofbirth = $("#dob").val();
              var ukaddress = $("#ukaddress").val();
              var nepaladdress = $("#nepaladdress").val();
              var passnum = $("#passport_number").val();

              $.post(
                  "library/user_controller.php", {
                      "action": 'register',
                      "fullname": membername,
                      "member_lastname":lname,
                      "email": membremail,
                      "password": password,
                      "phone": phonenum,
                      "dob": dateofbirth,
                      "ukaddress": ukaddress,
                      "nepaladdress": nepaladdress,
                      "passport": passnum
                  },
                  function(data) {
                      console.log(data);
                      uploadimage();
                  }
              );
          }
      });




      var imagefiles;

      $('#passprtimg').on('change', preparePhotoUpload);

      function preparePhotoUpload(event) {

          $('.pass-uploaded').css('display', '-webkit-inline-box');

          imagefiles = event.target.files;
      }


      $('#addressproof').on('change', prepareProofUpload);

      function prepareProofUpload(event) {

          $('.proof-uploaded').css('display', '-webkit-inline-box');

          //imagefiles = event.target.files;
      }



      function uploadimage() {

          var data = new FormData();

          //adding file content to data
          $.each(imagefiles, function(key, value) {
              //console.log(value);
              data.append("action", "uploadPassport");
              data.append("passportimg", value);

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
                  //window.location.reload();
                  console.log(data);
                  $("#addMemberForm").submit();
                  //$(".se-pre-con").fadeOut("slow");
                  //$(".alert-success").slideDown("slow");
              }
          });
      }



      $("#addMemberForm").submit(function(event) {

          event.preventDefault();

          var addForm = $('#addMemberForm').serialize();
          console.log(addForm);
          $.ajax({
              type: 'POST',
              url: 'library/user_controller.php',
              data: addForm,
              success: function(data) {
var realdata = JSON.parse(data)
                  console.log(realdata[0]["user_id"]);
                 window.location.href = 'http://nrna.co.uk/view.php?id='+realdata[0]["user_id"];
                  //parseJSON(data);
              }
          });
      });


      function parseJSON(string) {
          var result_of_parsing_json = JSON.parse(string);
          console.log(result_of_parsing_json[0]["email"]);

          $('#pay_amount').val(result_of_parsing_json[0]["amount"]);
          $('#pay_name').val(result_of_parsing_json[0]["name"]);
          $('#pay_email').val(result_of_parsing_json[0]["email"]);
          $('#item_number').val(result_of_parsing_json[0]["user_id"]);

          document.nrnaForm.submit();
      }

  }); /* $(document) close */

</script>