<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['bank'])) {
        $valid = 0;
        $error_message .= "Bank Name can not be empty<br>";
    } else {
		// Duplicate Bank checking
    	// current Bank name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM swift_details WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_bank = $row['bank'];
		}

    }

    if($valid == 1) {

    	
    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE swift_details SET bank=?, swift_code=?, branch=?, country=?, country_code=?, city=?, address=?   WHERE id=?");
		$statement->execute(array($_POST['bank'],$_POST['swift_code'],$_POST['branch'],$_POST['country'],$_POST['country_code'],$_POST['city'],$_POST['address'],$_REQUEST['id']));

    	$success_message = 'Swift Code Details is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM swift_details WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Swift Code Details</h1>
	</div>
	<div class="content-header-right">
		<a href="swift.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$bank = $row['bank'];
	$swift_code = $row['swift_code'];
	$branch = $row['branch'];
	$country = $row['country'];
	$country_code = $row['country_code'];
	$city = $row['city'];
}
?>

<section class="content">

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

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Bank Name <span>*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="bank" value="<?php echo $bank; ?>">
                    </div>
                </div>
               <div class="form-group">
					<label for="" class="col-sm-2 control-label">Swift BIC Code<span>*</span> </label>
					<div class="col-sm-6">
						<input type="text" class="form-control"  name="swift_code" value="<?php echo $swift_code; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Branch <span>*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control"  name="branch" value="<?php echo $branch; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Country <span>*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Country Code <span>*</span></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="country_code" value="<?php echo $country_code; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">City </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Address</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
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
  </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>