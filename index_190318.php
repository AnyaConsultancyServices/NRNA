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
            <form role="form" name="signupForm" id="signupForm" action="" method="post" enctype="multipart/form-data">
               <div id="msform">
                  <!-- progressbar -->
                  <ul id="progressbar">
                     <li class="active">Account Setup</li>
                     <li>Personal Details</li>
                     <li>Identification proofs</li>
                  </ul>
                  <!-- fieldsets -->
                  <fieldset>
                     <h2 class="fs-title">Create your account</h2>
                     <input type="text" id="fullname" name="fullname" placeholder="Name *" value="" autocomplete="off" />
                     <input type="text" id="email" name="email" placeholder="Email *" value="" autocomplete="off" onBlur="checkAvailability()" style="margin-bottom: 0px;" /><span id="email-availability-status"></span>
                     <p><img src="img/LoaderIcon.gif" id="loaderIcon" style="display:none;" /></p>
                     <input type="password" id="password" name="password" value="" placeholder="Password *" autocomplete="off" />
                     <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password *" autocomplete="off" /></br>
                     <input type="button" name="next" class="next action-button" value="Next" />
                     <p class="">
                        <small>Already have an account?  <a href="login.php">Login Now</a></small>
                     </p>
                  </fieldset>
                  <fieldset>
                     <h2 class="fs-title">Personal Details</h2>
                     <!--<h3 class="fs-subtitle">We will never sell it</h3>-->
                     <input type="text" id="phone" name="phone" value="" placeholder="Contact Number *" autocomplete="off" />
                     <input type="text" class="datepicker" id="dob" name="dob" placeholder="Date of Birth *" value="" autocomplete="off" />
                     <textarea id="ukaddress" name="ukaddress" placeholder="UK Address *"></textarea>
                     <textarea id="nepaladdress" name="nepaladdress" placeholder="Nepal Address *"></textarea>
                     </br>
                     <input type="button" name="previous" class="previous action-button" value="Previous" />
                     <input type="button" name="next" class="next action-button" value="Next" />
                  </fieldset>
                  <fieldset>
                     <h2 class="fs-title">Identification proofs</h2>
                     <!--<h3 class="fs-subtitle">Your presence on the social network</h3>-->
                     <input type="text" name="passport_number" id="passport_number" placeholder="Passport Number *" autocomplete="off" style="text-transform: lowercase" />
                     <div class="upload-btn-wrapper">
                        <button class="btn">Upload your Passport copy * <span class="pass-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>
                        <input type="file" name="passprtimg" id="passprtimg" />
                     </div>
                     <div class="upload-btn-wrapper">
                        <button class="btn">Upload your Address proof <span class="proof-uploaded" style="display: none; color: #27AE60;"><i class="fa fa-check fa-lg"></i></span></button>
                        <input type="file" name="addressproof" id="addressproof" />
                     </div>
                     <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#addMemberModal">Add Family Members <span><i class="fa fa-plus-circle fa-lg"></i></button>
                     <input type="button" name="previous" class="previous action-button" value="Previous" />
                     <input type="submit" name="submit" class="submit action-button" value="Submit" />
                  </fieldset>
               </div>
            </form>
         </div>
      </div>
      <!-- end #main-wrapper -->
      <div id="addMemberModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <form role="form" name="addMemberForm" id="addMemberForm" action="#" method="post" enctype="multipart/form-data">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                     ×
                     </button>
                     <h4 class="modal-title" id="classModalLabel">
                        <b> Enter Family Member Details </b>
                     </h4>
                  </div>
                  <div class="modal-body" style="overflow-x: auto;">
                     <table id="familytable" class="table table-bordered">
                        <thead>
                           <th class="center">Relation</th>
                           <th>Member Name</th>
                           <th>Member Email</th>
                           <th>DOB</th>
                           <th>Passport Number</th>
                        </thead>
                        <tbody>
                           <tr>
                              <td>
                                 <select name="mem_relation[]" required="required">
                                    <option value="">Select</option>
                                    <option value="mother">Mother</option>
                                    <option value="father">Father</option>
                                    <option value="wife">Wife</option>
                                    <option value="son">Son</option>
                                    <option value="daughter">Daughter</option>
                                 </select>
                              </td>
                              <td>
                                 <input type="text" name="mem_name[]" value="" required="required" autocomplete="off">
                              </td>
                              <td>
                                 <input type="email" name="mem_email[]" value="" required="required" autocomplete="off">
                              </td>
                              <td>
                                 <input type="text" class="datepicker" name="mem_dob[]" value="" required="required" autocomplete="off">
                              </td>
                              <td>
                                 <input type="text" name="mem_passport[]" required="required" autocomplete="off">
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <a href="#" class="btn-sm btn-success pull-right" id="insert-more" style="text-decoration: none;"> <i class="fa fa-plus-circle fa-lg"></i> &nbsp; One more</a>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn-sm btn-primary" data-dismiss="modal">
                     Add Member(s)
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- end #addMemberModal -->
      <div class="modal fade" id="OTPModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                  <h4 class="modal-title">OTP Verification</h4>
                  <span class="has-error err-alt" style="display: none; color: red;">Sorry, OPT is worng.</span>
               </div>
               <form role="form" id="OTPform" name="OTPform" action="" method="post">
                  <div class="modal-body">
                     <p>We have sent OTP to your mobile number.</p>
                     <input type="text" name="otpvalue" id="otpvalue" value="" />
                     <input type="submit" name="submit" class="submit action-button" value="Submit" />
                  </div>
                  <!--<div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>-->
               </form>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
   </body>
</html>

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- JQuery Validation Plugin -->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/validation-methods.js" type="text/javascript"></script>

<script type="text/javascript">

  $(function() {

      $(".se-pre-con").fadeOut("slow");

      //$("#dob").datepicker({ dateFormat: 'dd-mm-yy' });

      $(".datepicker").datepicker({
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
              var tds = '<tr>';
              jQuery.each($('tr:last td', this), function() {
                  tds += '<td>' + $(this).html() + '</td>';
              });
              tds += '</tr>';
              if ($('tbody', this).length > 0) {
                  $('tbody', this).append(tds);
              } else {
                  $(this).append(tds);
              }
          });
      });
  });


  function checkAvailability() {
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
  }


  $(document).ready(function(){

      $("#phone").focusout(function(){

        $(".se-pre-con").fadeIn("slow");

        var phnno = $("#phone").val();

        if(phnno != '') {

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

                      if(data == 'success') {

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
                  $(".se-pre-con").fadeOut("slow");
                  $(".alert-success").slideDown("slow");
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
                  console.log(data);
                  $(".se-pre-con").fadeOut("slow");
              }
          });
      });

  }); /* $(document) close */
</script>

