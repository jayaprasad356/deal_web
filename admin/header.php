<?php
ob_start();
session_start();
include("../config/config.php");
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Check if the user is logged in or not
if(!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}

// Getting data from the website settings table
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$receive_email = $row['receive_email'];
	$meta_title_home = $row['meta_title_home'];
}

// Current Page Access Level check for all pages
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $meta_title_home; ?> - Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/uploads/favicon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/jquery.fancybox.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">
	<link rel="stylesheet" href="css/on-off-switch.css">
	<link rel="stylesheet" href="css/summernote.css">
	<link rel="stylesheet" href="style.css">


</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	<div class="wrapper">

		<header class="main-header">

			<a href="index.php" class="logo">
				<span class="logo-lg">Code Finder</span>
			</a>

			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
					
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="../assets/uploads/<?php echo $_SESSION['user']['photo']; ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo 'Admin'; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-footer">
									<div>
										<a href="profile-edit.php" class="btn btn-default btn-flat">Edit Profile</a>
									</div>
									<div>
										<a href="logout.php" class="btn btn-default btn-flat">Log out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			</nav>
		</header>

  		<?php $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>

  		<aside class="main-sidebar">
    		<section class="sidebar">
      
      			<ul class="sidebar-menu">

			        <li class="treeview <?php if($cur_page == 'index.php') {echo 'active';} ?>">
			          <a href="index.php">
			            <i class="fa fa-home"></i> <span>Home</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="users.php">
			            <i class="fa fa-users"></i> <span>User</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="categories.php">
			            <i class="fa fa-list"></i> <span>categories</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="subcategories.php">
			            <i class="fa fa-tag"></i> <span>Sub categories</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="item.php">
			            <i class="fa fa-list"></i> <span>Items</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="reports.php">
			            <i class="fa fa-file"></i> <span>Reports</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="notifications.php">
			            <i class="fa fa-bell"></i> <span>Notifications</span>
			          </a>
			        </li>
					<li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user-edit.php')||($cur_page == 'user.php') ) {echo 'active';} ?>">
			          <a href="login.php">
					  <i class="fa fa-sign-out"></i> <span>Logout</span>
			          </a>
			        </li>
				
        
      			</ul>
    		</section>
  		</aside>

  		<div class="content-wrapper">