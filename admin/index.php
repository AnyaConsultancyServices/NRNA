<?php 
include('../library/db_config.php');
if(isset($_SESSION['user_id'])):
header("Location: members.php");
endif;
include('../library/db_config.php');
if (isset($_POST["login-button"], $_POST["username"]) && $_POST["username"] != "" && $_POST["password"] != "")
	{
                $err_msg = '';
		if (!isset($_SESSION["attempts"])):
			$_SESSION["attempts"] = 0;
			$_SESSION["blocklist"] = '';
		endif;
	
		if ($_SESSION["blocklist"] != $_POST["username"])
		{
			$username = $_POST["username"];
			$pass = $_POST["password"];
			$status = 'active';
			$lgnQry = $pdodb->prepare("SELECT * FROM users WHERE username=:username AND password=:pass AND status=:status");
			$lgnQry->bindParam("username", $username, PDO::PARAM_STR);
			$lgnQry->bindParam("pass", $pass, PDO::PARAM_STR);
			$lgnQry->bindParam("status", $status, PDO::PARAM_STR);
			$lgnQry->execute();
			$count = $lgnQry->rowCount();
			if ($count > 0)
			{
				$data = $lgnQry->fetch(PDO::FETCH_OBJ);
				$_SESSION['user_id'] = $data->id;
				$_SESSION['user_name'] = $data->username;
				header("Location: dashboard.php");
				exit;
			}
			else
			{
				$err_msg = 'Please Check Login Details';
				$_SESSION["attempts"] = $_SESSION["attempts"] + 1;
			}
		}
		else
		{
			$_SESSION["blocklist"] = $_POST["email"];
			$err_msg = "You've failed too many times, Try after 30 minutes.";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<meta charset="utf-8">
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
<div class="main">
  <div class="login-form">
    <h1>Admin Login</h1>
<?php if($err_msg!=''): ?>
<p class="error"><?php echo $err_msg; ?></p>
<?php endif;
?>
    <div class="head"> <img src="images/user.png" alt=""/> </div>
    <form id="" action="" method="post" role="form">
      <div class="input-group">
        <div class="form-line">
          <div class="form-group field-mainloginform-username required">
            <input type="text" id="mainloginform-username" class="form-control" name="username" autofocus placeholder="Username" aria-required="true">
            <p class="help-block help-block-error"></p>
          </div>
          <!-- <input type="text" class="form-control" name="username" placeholder="Username" required autofocus> -->
        </div>
      </div>
      <div class="input-group">
        <div class="form-line">
          <div class="form-group field-mainloginform-password required">
            <input type="password" id="mainloginform-password" class="form-control" name="password" placeholder="Password" aria-required="true">
            <p class="help-block help-block-error"></p>
          </div>
          <!--                             <input type="password" class="form-control" name="password" placeholder="Password" required> -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8 p-t-5">
          <label class="checkbox" for="rememberme">
            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
            Remember Me</label>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-lg btn-default" name="login-button">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
