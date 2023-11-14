<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['full_name'])) {
        $valid = 0;
        $error_message .= "Name can not be empty<br>";
    }

    if(empty($_POST['email'])) {
        $valid = 0;
        $error_message .= 'Email address can not be empty<br>';
    } else {
    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	        $valid = 0;
	        $error_message .= 'Email address must be valid<br>';
	    } else {
	    	// current email address that is in the database
	    	$statement = $pdo->prepare("SELECT * FROM tbl_users WHERE id=?");
			$statement->execute(array($_REQUEST['id']));
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$current_email = $row['email'];
			}

	    	$statement = $pdo->prepare("SELECT * FROM tbl_users WHERE email=? and email!=?");
	    	$statement->execute(array($_POST['email'],$current_email));
	    	$total = $statement->rowCount();							
	    	if($total) {
	    		$valid = 0;
	        	$error_message .= 'Email address already exists<br>';
	    	}
	    }
    }

    if($valid == 1) {

		// updating the database
		$statement = $pdo->prepare("UPDATE tbl_users SET full_name=?, email=?, phone=? WHERE id=?");
		$statement->execute(array($_POST['full_name'],$_POST['email'],$_POST['phone'] ,$_REQUEST['id']));

    	$success_message = 'users Information is updated successfully.';
    }
}


if(isset($_POST['form2'])) {

	$valid = 1;

	$path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
    	// removing the existing photo
    	$statement = $pdo->prepare("SELECT * FROM tbl_users WHERE id=?");
    	$statement->execute(array($_REQUEST['id']));
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    	foreach ($result as $row) {
    		$photo = $row['photo'];
    	}
    	if($photo!='') {
    		unlink('../assets/uploads/'.$photo);	
    	}

    	// updating the data
    	$final_name = 'users-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
		$statement = $pdo->prepare("UPDATE tbl_users SET photo=? WHERE id=?");
		$statement->execute(array($final_name,$_REQUEST['id']));

        $success_message = 'users Photo is updated successfully.';
    	
    }
}




?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_users WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 || $_REQUEST['id'] == 1 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit users</h1>
	</div>
	<div class="content-header-right">
		<a href="users.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php
$statement = $pdo->prepare("SELECT * FROM tbl_users WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$full_name = $row['full_name'];
	$email     = $row['email'];
	$phone     = $row['phone'];
	$photo     = $row['photo'];
}
?>


<section class="content" style="min-height:auto;margin-bottom: -30px;">
	<div class="row">
		<div class="col-md-12">
			<?php if($error_message): ?>
			<div class="callout callout-danger">
			<h4>Please correct the following errors:</h4>
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			<h4>Success:</h4>
			<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Update Information</a></li>
						<li><a href="#tab_2" data-toggle="tab">Update Photo</a></li>
					</ul>
					<div class="tab-content">
          				<div class="tab-pane active" id="tab_1">
							
							<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Name <span>*</span></label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="full_name" value="<?php echo $full_name; ?>">
										</div>
									</div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
											<?php
											if($photo == '') {
												echo '<img src="../assets/uploads/no-photo.jpg" style="width:150px;">';
											} else {
												echo '<img src="../assets/uploads/'.$photo.'"  style="width:150px;">';
											}
											?>
							                
							            </div>
							        </div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Email Address <span>*</span></label>
										<div class="col-sm-4">
											<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Phone </label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form1">Update Information</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>
          				<div class="tab-pane" id="tab_2">
							
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form2">Update Photo</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>

          				</div>
          			</div>
				</div>
			
		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>