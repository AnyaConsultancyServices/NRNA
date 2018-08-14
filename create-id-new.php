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
width: 204.09448819px;
    height: 322.77165354px;
    background-color: #fff;
    padding: 0px;
    border-radius: 0px;
    text-align: center;
    box-shadow: 0 0 1.5px 0px #b9b9b9;
    position: relative;
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
    height: 68px;
    overflow: hidden;
    position: relative;
    left: 0;
    text-align: center;
    margin: 0 auto;
        background-size: cover;
    background-position: top center;
    background-repeat: no-repeat;
}

</style>

<!--<div class="id-card-tag"></div>
   <div class="id-card-tag-strip"></div>
   <div class="id-card-hook"></div>
   <div class="id-card-holder">-->

	<div class="id-card" id="html-content-holder">
	   <img style="position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 0.64in;" src="IDcard/vi_1.png" />
	   <img style="position: relative; top: 9px;left: 0; width: 100%; height: auto;" src="IDcard/ci_2.png" />
	   <div style="color:#000080;font-size: 10px;font-weight: 800;margin-top: 13px;">NON-RESIDENTIAL ASSOCIATION</div>
	   	   <div style="color:#87CEEB;font-size: 10px;font-weight: 700;margin-bottom: 13px;margin-top: 4px;">National Coordinator Council, UK</div>
	   
	   <div class="image-outer" style="background-image:url(<?php echo $row['mem_image']; ?>);">
	   
	   </div>
	   <div style="position: relative; ">
		  <h3 style="color:#000080;"><strong><?php echo $row['member_name']; ?></strong></h3>
		  <h3 style="color:#87CEEB;"><strong>Member</strong></h3>
		  </br>
	   </div>
	   <div style="background-color: #87CEEB; height: 62px; width: 100%; border-radius: 100% 0px 0px 0px; border-top: 3px solid navy; bottom: 0px; position: absolute;">
		   <div style="position: relative;top: 22px;right: 12px;float: right;">
			  <h3 style="color:#000080;font-size: 10px;"><strong>Membership No : <?php echo $nrna_id; ?> </strong></h3>
			  <h3 style="color:#000080;font-size: 10px;"><strong>Valid Till : 31 July, 2019</strong></h3>
			  </br>
		   </div>
	   </div>
	</div>
	</br>
	<input id="btn-Preview-Image" type="button" value="Preview"/>
	<a id="btn-Convert-Html2Image" href="#">Download</a><br/></br>
	<h3>Preview :</h3>
	</br>
	<div id="previewImage"></div>

<!--</div>-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/html2canvas.js"></script>
<script>
    $(document).ready(function() {

        var element = $("#html-content-holder"); // global variable
        var getCanvas; // global variable

        $("#btn-Preview-Image").on('click', function() {
            html2canvas(element, {
                onrendered: function(canvas) {
                    $("#previewImage").append(canvas);
                    getCanvas = canvas;
                }
            });
        });

        $("#btn-Convert-Html2Image").on('click', function() {
            var imgageData = getCanvas.toDataURL("image/png");
            // Now browser starts downloading it instead of just showing it
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#btn-Convert-Html2Image").attr("download", "your_id_card.png").attr("href", newData);
        });

    });
</script>
   
</body>
</html>