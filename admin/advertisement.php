<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
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

    	if($path=='') {
    		// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_url=?, adv_status=? WHERE adv_id=1");
			$statement->execute(array($_POST['adv_url'],$_POST['adv_status']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_photo']);

			$final_name = 'advertisement-1'.'.'.$ext;
			move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
			

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_photo=?, adv_url=?, adv_status=? WHERE adv_id=1");
			$statement->execute(array($final_name,$_POST['adv_url'],$_POST['adv_status']));
    	}

    	$success_message = 'Advertisement is updated successfully.';
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

		if($path=='') {
    		// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_url=?, adv_status=? WHERE adv_id=2");
			$statement->execute(array($_POST['adv_url'],$_POST['adv_status']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_photo']);

			$final_name = 'advertisement-2'.'.'.$ext;
			move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
			

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_photo=?, adv_url=?, adv_status=? WHERE adv_id=2");
			$statement->execute(array($final_name,$_POST['adv_url'],$_POST['adv_status']));
    	}

    	$success_message = 'Advertisement is updated successfully.';
    }
	
}

if(isset($_POST['form3'])) {
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

		if($path=='') {
    		// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_url=?, adv_status=? WHERE adv_id=3");
			$statement->execute(array($_POST['adv_url'],$_POST['adv_status']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_photo']);

			$final_name = 'advertisement-3'.'.'.$ext;
			move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
			

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_photo=?, adv_url=?, adv_status=? WHERE adv_id=3");
			$statement->execute(array($final_name,$_POST['adv_url'],$_POST['adv_status']));
    	}

    	$success_message = 'Advertisement is updated successfully.';
    }
	
}
if(isset($_POST['form4'])) {
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

		if($path=='') {
    		// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_url=?, adv_status=? WHERE adv_id=4");
			$statement->execute(array($_POST['adv_url'],$_POST['adv_status']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_photo']);

			$final_name = 'advertisement-4'.'.'.$ext;
			move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
			

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_photo=?, adv_url=?, adv_status=? WHERE adv_id=4");
			$statement->execute(array($final_name,$_POST['adv_url'],$_POST['adv_status']));
    	}

    	$success_message = 'Advertisement is updated successfully.';
    }
	
}
if(isset($_POST['form5'])) {
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

		if($path=='') {
    		// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_url=?, adv_status=? WHERE adv_id=5");
			$statement->execute(array($_POST['adv_url'],$_POST['adv_status']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_photo']);

			$final_name = 'advertisement-5'.'.'.$ext;
			move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
			

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_photo=?, adv_url=?, adv_status=? WHERE adv_id=5");
			$statement->execute(array($final_name,$_POST['adv_url'],$_POST['adv_status']));
    	}

    	$success_message = 'Advertisement is updated successfully.';
    }
	
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Advertisement</h1>
	</div>
</section>


<?php
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {

	$adv_url[] = $row['adv_url'];
	$adv_status[] = $row['adv_status'];
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
						<li class="active"><a href="#tab_1" data-toggle="tab">Header Ads</a></li>
						<li><a href="#tab_2" data-toggle="tab">Sidebar Ads </a></li>
						<li><a href="#tab_3" data-toggle="tab">Center Ads</a></li>
						<li><a href="#tab_4" data-toggle="tab">Above Content</a></li>
						<li><a href="#tab_5" data-toggle="tab">Below Content</a></li>
					</ul>
					<div class="tab-content">
          				<div class="tab-pane active" id="tab_1">
							
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									
							       
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Adsense Code</label>
							            <div class="col-sm-6">
							                <textarea class="form-control" name="adv_url"><?php echo $adv_url[0]; ?></textarea>
							            </div>
							        </div>
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Show? </label>
							            <div class="col-sm-6">
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Show" <?php if($adv_status[0] == 'Show') { echo 'checked'; } ?>>Yes
							                </label>
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Hide" <?php if($adv_status[0] == 'Hide') { echo 'checked'; } ?>>No
							                </label>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
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
							            <label for="" class="col-sm-2 control-label">Adsense Code</label>
							            <div class="col-sm-6">
							                <textarea class="form-control" name="adv_url"><?php echo $adv_url[1]; ?></textarea>
							            </div>
							        </div>
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Show? </label>
							            <div class="col-sm-6">
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Show" <?php if($adv_status[1] == 'Show') { echo 'checked'; } ?>>Yes
							                </label>
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Hide" <?php if($adv_status[1] == 'Hide') { echo 'checked'; } ?>>No
							                </label>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form2">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>
          				<div class="tab-pane" id="tab_3">

							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									
							        
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Adsense Code</label>
							            <div class="col-sm-6">
							                <textarea class="form-control" name="adv_url"><?php echo $adv_url[2]; ?></textarea>
							            </div>
							        </div>
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Show? </label>
							            <div class="col-sm-6">
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Show" <?php if($adv_status[2] == 'Show') { echo 'checked'; } ?>>Yes
							                </label>
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Hide" <?php if($adv_status[2] == 'Hide') { echo 'checked'; } ?>>No
							                </label>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form3">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>
						<div class="tab-pane" id="tab_4">

							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									
							       
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Adsense Code</label>
							            <div class="col-sm-6">
										<textarea class="form-control" name="adv_url"><?php echo $adv_url[3]; ?></textarea>
							                
							            </div>
							        </div>
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Show? </label>
							            <div class="col-sm-6">
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Show" <?php if($adv_status[3] == 'Show') { echo 'checked'; } ?>>Yes
							                </label>
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Hide" <?php if($adv_status[3] == 'Hide') { echo 'checked'; } ?>>No
							                </label>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form4">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>
						<div class="tab-pane" id="tab_5">

							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									
							       
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Adsense Code</label>
							            <div class="col-sm-6">
										<textarea class="form-control" name="adv_url"><?php echo $adv_url[4]; ?></textarea>
							                
							            </div>
							        </div>
							        <div class="form-group">
							            <label for="" class="col-sm-2 control-label">Show? </label>
							            <div class="col-sm-6">
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Show" <?php if($adv_status[4] == 'Show') { echo 'checked'; } ?>>Yes
							                </label>
							                <label class="radio-inline">
							                    <input type="radio" name="adv_status" value="Hide" <?php if($adv_status[4] == 'Hide') { echo 'checked'; } ?>>No
							                </label>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form5">Update</button>
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

</section>

<?php require_once('footer.php'); ?>