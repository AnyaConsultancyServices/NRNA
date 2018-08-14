<?php 
/****All Members Page***/
include('library/db_config.php');
if(!isset($_SESSION['user_id'])):
header("Location: index.php");
endif;
if(isset($_GET['id'])):
$ids = $_GET['id'];
else:
header("Location: index.php");
endif;
    $result = $pdodb->prepare("SELECT * FROM `nrna_members` WHERE member_id = '".$ids."'");
    $result->execute();
    $row = $result->fetch();
    $id = str_pad($row['member_id'], 4, "0", STR_PAD_LEFT);
    $nrna_id = 'UK'.$id;
?>
<html>
<head>
</head>
<body>

<style type="text/css">
    *{
        margin:0;
        padding:0;
    }
body {
            background-color: #d7d6d3;
            font-family:'verdana';
        }
        .id-card-holder {
            width: 225px;
            padding: 4px;
            margin: 0 auto;
            background-color: #1f1f1f;
            border-radius: 5px;
            position: relative;
        }
        .id-card-holder:after {
            content: '';
            width: 7px;
            display: block;
            background-color: #0a0a0a;
            height: 100px;
            position: absolute;
            top: 105px;
            border-radius: 0 5px 5px 0;
        }
        .id-card-holder:before {
            content: '';
            width: 7px;
            display: block;
            background-color: #0a0a0a;
            height: 100px;
            position: absolute;
            top: 105px;
            left: 222px;
            border-radius: 5px 0 0 5px;
        }
        .id-card {
height: 204.09448819px;
    width: 322.77165354px;
    background-color: #87CEEB;
    padding: 0px;
    box-shadow: 0 0 1.5px 0px #b9b9b9;
    position: relative;
    float:left;
    margin-right: 20px;
    margin-top: 20px;
    background-position: -126px 38px;
    border-radius: 10px;
    background-repeat: no-repeat;
        }
        .preview-btns{
    width: 90%;
    float: left;
    margin-top: 30px;
    margin-left: 20px;
        }
        .id-card img {
            margin: 0 auto;
        }
        .header img {
            width: 100px;
            margin-top: 15px;
        }
        .photo img {
            width: 80px;
            margin-top: 15px;
        }
        h2 {
            font-size: 15px;
            margin: 5px 0;
        }
        h3 {
            font-size: 12px;
            margin: 2.5px 0;
            font-weight: 300;
        }
        .qr-code img {
            width: 50px;
        }
        p {
            font-size: 5px;
            margin: 2px;
        }
        .id-card-hook {
            background-color: #000;
            width: 70px;
            margin: 0 auto;
            height: 15px;
            border-radius: 5px 5px 0 0;
        }
        .id-card-hook:after {
            content: '';
            background-color: #d7d6d3;
            width: 47px;
            height: 6px;
            display: block;
            margin: 0px auto;
            position: relative;
            top: 6px;
            border-radius: 4px;
        }
        .id-card-tag-strip {
            width: 45px;
            height: 40px;
            background-color: #0950ef;
            margin: 0 auto;
            border-radius: 5px;
            position: relative;
            top: 9px;
            z-index: 1;
            border: 1px solid #0041ad;
        }
        .id-card-tag-strip:after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #c1c1c1;
            position: relative;
            top: 10px;
        }
        .id-card-tag {
            width: 0;
            height: 0;
            border-left: 100px solid transparent;
            border-right: 100px solid transparent;
            border-top: 100px solid #0958db;
            margin: -10px auto -30px auto;
        }
        .id-card-tag:after {
            content: '';
            display: block;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-top: 100px solid #d7d6d3;
            margin: -10px auto -30px auto;
            position: relative;
            top: -130px;
            left: -50px;
        }
   .image-outer {
    width: 82px;
    height: 82px;
    overflow: hidden;
    position: relative;
    right: 11px;
    top: 13px;
    float: right;
    text-align: right;
    background-size: cover;
    background-position: top right;
    background-repeat: no-repeat;
}
.image-signature {
    position: absolute;
    bottom: 0px;
    right: 10px;
    text-align: right;
    width: 82px;
}
.image-hologram{
    position: absolute;
    top: 0;
    right: 28px;
    text-align: right;
    width: 62px;
}
.btn-default {
    background-color: #000080;
    color: #fff;
    text-decoration: unset;
    padding: 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
</style>

<!--<div class="id-card-tag"></div>
   <div class="id-card-tag-strip"></div>
   <div class="id-card-hook"></div>
   <div class="id-card-holder">-->

	<div class="id-card" id="html-content-holder" style="background-image:url('IDcard/logo-front.png'); margin-left: 20px;">
	   <img style="position: relative; top: 9px;left: 10px; width: 83%; height: auto;" src="IDcard/logo-id.png" />
	   
	   <div class="image-outer" style="background-image:url(<?php echo $row['mem_image']; ?>);">
	       
	   
	   </div>
	   
	   <div style="position: relative; top: 31px; text-align:center;">
		  <h3 style="color:#000080; padding: 3px 0; font-size: 14px;
    font-weight: 700;"><strong><?php echo $row['member_name']; ?></strong></h3>
		  <h3 style="color:#000;font-size: 12px;"><strong>NRNA ID No : <?php echo $nrna_id; ?> </strong></h3>
		  <h3 style="color:#000;font-size: 12px; padding: 4px 0;"><strong><?php echo $row['profession']; ?>, UK </strong></h3>
		  </br>
		  <div class="image-signature">
	   <img style="position: relative;top: 9px;left: 10px;  width: 100%;    height: auto;" src="IDcard/signaure.png" />
	   </div>
	   </div>
	   
	   <div style="position: absolute; bottom: 10px; text-align:left; left: 10px;
    width: 95%;">
		  
		  <h3 style="color:#000;font-size: 10px;  float:left;"><strong>Valid Until :  14th July 2020 </strong></h3>
		  <h3 style="color:#000;font-size: 10px; float:right;"><strong>Authorized Signature</strong></h3>
		  
	   </div>

	</div>
	<div class="id-card" id="html-content-holder2" style="background-image:url('IDcard/logo-back.png');background-position: center 40px; background-size: contain;">
	   
	   <div style="position: relative; top: 7px; left:10px; text-align:left;">
	
		  <h3 style="color:#000;font-size: 12px;"><strong>Address : <span style=" float: right;  width: 79%; font-size: 10px;">NRNA UK<br>16 Queen Mary Avenue,<br> Basingstoke, Hants, RG21 5PF</span></strong></h3>
		 <div class="image-hologram">
	   <img style="position: relative;top: 9px;left: 10px;  width: 100%;    height: auto;" src="IDcard/qr-code.png" />
	   </div>
	   </div>
	   
	   
	   <div style="position: absolute; bottom: 10px; text-align:left; left: 10px;
    width: 95%;">
		  
		  <h3 style="color:#000;font-size: 12px; "><strong>If Found Please Return to:  </strong></h3>
		  <h3 style="color:#000;font-size: 10px;"><strong>NRNA Headquarter, Kathmandu, Nepal<br>
P.O.Box: 1189, Tel: +977 1 4004529, Email:info@nrna.org</strong></h3>
		  
	   </div>

	</div>
	
	</br>
	<div class="preview-btns">
	<input id="btn-Preview-Image" type="button" class="btn btn-default" value="Preview"/>
	<a id="btn-Convert-Html2Image" title="<?php echo $nrna_id; ?>" class="btn btn-default" href="#">Download front Page</a>
	<a id="btn-Convert-Html2Image2" title="<?php echo $nrna_id; ?>" class="btn btn-default" href="#" style="">Download card Back Page</a><br/></br>
	<h3>Preview :</h3>
	</div>
	</br>
	<div id="previewImage" style=" float: left; margin-left: 20px; margin-right: 20px;"></div>
	<div id="previewImage2" style=" float: left;"></div>

<!--</div>-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/html2canvas.js"></script>
<script>
    $(document).ready(function() {

        var element = $("#html-content-holder"); // global variable
        
        var element2 = $("#html-content-holder2"); // global variable
        
        var getCanvas; // global variable

        $("#btn-Preview-Image").on('click', function() {
            html2canvas(element, {
                onrendered: function(canvas) {
                    $("#previewImage").append(canvas);
                    getCanvas = canvas;
                }
            });
        });
        
         $("#btn-Preview-Image").on('click', function() {
            html2canvas(element2, {
                onrendered: function(canvas) {
                    $("#previewImage2").append(canvas);
                    getCanvas2 = canvas;
                }
            });
            
        });

        $("#btn-Convert-Html2Image").on('click', function() {
            var uk_num = $(this).attr('title');
            var imgageData = getCanvas.toDataURL("image/png");
            console.log(imgageData);
            var imgageData2 = getCanvas2.toDataURL("image/png");
            console.log(imgageData2);
            // Now browser starts downloading it instead of just showing it
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            var newData2 = imgageData2.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#btn-Convert-Html2Image").attr("download", uk_num+"_id_card_front.png").attr("href", newData);
            $("#btn-Convert-Html2Image2").attr("download", uk_num+"_id_card_backend.png").attr("href", newData2);
        });
        
          $("#btn-Convert-Html2Image2").on('click', function() {
              var uk_num = $(this).attr('title');
            var imgageData = getCanvas.toDataURL("image/png");
            console.log(imgageData);
            var imgageData2 = getCanvas2.toDataURL("image/png");
            console.log(imgageData2);
            // Now browser starts downloading it instead of just showing it
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            var newData2 = imgageData2.replace(/^data:image\/png/, "data:application/octet-stream");
           $("#btn-Convert-Html2Image").attr("download", uk_num+"_id_card_front.png").attr("href", newData);
            $("#btn-Convert-Html2Image2").attr("download", uk_num+"_id_card_backend.png").attr("href", newData2);
        });

    });
</script>
   
</body>
</html>