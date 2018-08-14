<?php 
/****View Details Page***/
include('../library/db_config.php');
if(!isset($_SESSION['user_id'])):
header("Location: index.php");
endif;
if(isset($_GET['id'])):
$ids = $_GET['id'];
else:
header("Location: members.php");
endif;
    $result = $pdodb->prepare("SELECT * FROM `nrna_members` WHERE member_id = '".$ids."'");
    $result->execute();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>NRNA</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!-- CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!-- Fonts and icons -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    NRNA ADMIN
                </a>
            </div>
            <div class="sidebar-wrapper">
                      <ul class="nav">
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="members.php">
                            <i class="material-icons">person</i>
                            <p>All Members</p>
                        </a>
                    </li>
            </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Member Details </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Member Details</h4>
                                   
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Name</th>
                                            <th>Value</th>
                                  
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <th>Name</th><td><?php echo $row['member_name']; ?></td>
</tr><tr>
                                                <th>Email</th><td><?php echo $row['email']; ?></td>
</tr><tr>
                                                <th>Phone Number</th><td><?php echo $row['phone']; ?></td>
</tr><tr>
                                                <th>Date of Birth</th><td><?php echo $row['dob']; ?></td>
</tr><tr>
                                                <th>UK Address</th><td><?php echo $row['uk_address']; ?></td>
</tr><tr>
                                                <th>Nepal Address</th><td><?php echo $row['nepal_address']; ?></td>
</tr><tr>
                                                <th>Passport number</th><td><?php echo $row['passport_num']; ?></td>
<tr>
                                                <th>Profession</th><td><?php echo $row['profession']; ?></td>
</tr>
<tr>
                                                <th>Profession If otherss</th><td><?php echo $row['profession_others']; ?></td>
</tr>
<tr>
                                                <th>Income</th><td><?php echo $row['income']; ?></td>
</tr>
<tr>
                                                <th>Income Others</th><td><?php echo $row['income_others']; ?></td>
</tr>
<tr>
                                                <th>Like to Vote</th><td><?php echo $row['like_to_vote']; ?></td>
</tr>
<tr>
                                                <th>Paid Amount</th><td><?php echo $row['paid_amount']; ?></td>
</tr>
<tr>
                                                <th>Transaction ID</th><td><?php echo $row['txn_id']; ?></td>
</tr>
<tr>
                                                <th>Payment Status</th><td><?php echo $row['payment_status']; ?></td>
</tr>

<tr>
                                                <th>Passport Image</th><td><img  style="width: 150px;" src="../<?php echo $row['passport_img']; ?>" height="150" /></td>
</tr>

<tr>
                                                <th>Address Proof</th><td><img  style="width: 150px;" src="../<?php echo $row['address_proof']; ?>" height="150" /></td>
</tr>
<tr>
                                                <th>Download ID Card</th><td><a target="_blank" href="../create-id.php?id=<?php echo $row['member_id']; ?>">View</a></td>
                                            </tr>
                                            <?php } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>