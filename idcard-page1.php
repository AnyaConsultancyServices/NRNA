<html>
<head>
</head>
<body>

<style type="text/css">
    
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
            width: 330px;
			height:480px;
            background-color: #fff;
            padding: 0px;
            border-radius: 0px;
            text-align: center;
            box-shadow: 0 0 1.5px 0px #b9b9b9;
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

</style>

<!--<div class="id-card-tag"></div>
   <div class="id-card-tag-strip"></div>
   <div class="id-card-hook"></div>
   <div class="id-card-holder">-->

	<div class="id-card" id="html-content-holder">
	   <img style="position:absolute;top:0.56in;left:0.50in;width:2.62in;height:0.64in" src="IDcard/vi_1.png" />
	   <img style="position:absolute;top:0.50in;left:0.50in;width:2.62in;height:1.14in" src="IDcard/ci_2.png" />
	   <img style="position:absolute;top:1.70in;left:0.84in;width:1.93in;height:0.08in" src="IDcard/ci_3.png" />
	   <img style="position:absolute;top:1.85in;left:0.95in;width:1.71in;height:0.10in" src="IDcard/ci_4.png" />
	   <img style="position:absolute;top:2.01in;left:1.25in;width:1.10in;height:1.21in;" src="IDcard/ci_5.png" />
	   <div style="position:absolute;top:320px;left:125px;">
		  <h3 style="color:#000080;"><strong><?php echo $_GET['name']; ?></strong></h3>
		  <h3 style="color:#87CEEB;"><strong>Member</strong></h3>
		  </br>
	   </div>
	   <div style="background-color: #87CEEB; height: 80px; width: 253px; border-radius: 100% 0px 0px 0px; border-top: 3px solid navy; bottom: 250px; left: 43px; position: absolute;">
		   <div style="position:absolute;top:25px;left:65px;">
			  <h3 style="color:#000080;"><strong>Membership No : UK0001 </strong></h3>
			  <h3 style="color:#000080;"><strong>Valid Till : 31 July, 2019</strong></h3>
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