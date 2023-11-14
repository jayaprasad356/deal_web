<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form_home_ifsc'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET meta_title_home=?, meta_keyword_home=?, meta_description_home=?, home_title=?, home_description=? WHERE id=1");
	$statement->execute(array($_POST['meta_title_home'],$_POST['meta_keyword_home'],$_POST['meta_description_home'],$_POST['home_title'],$_POST['home_description']));

	$success_message = 'Home Meta settings is updated successfully.';
}


if(isset($_POST['form_home_pin'])) {
    	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET meta_title_pin=?, meta_keyword_pin=?, meta_description_pin=?, home_pin_title=?, home_pin_description=? WHERE id=1");
	$statement->execute(array($_POST['meta_title_pin'],$_POST['meta_keyword_pin'],$_POST['meta_description_pin'],$_POST['home_pin_title'],$_POST['home_pin_description']));

	$success_message = 'PIN Code Section is updated successfully.';
}



if(isset($_POST['form_home_swift'])) {
    $statement = $pdo->prepare("UPDATE tbl_settings SET meta_title_swift=?, meta_keyword_swift=?, meta_description_swift=?, home_swift_title=?, home_swift_description=? WHERE id=1");
	$statement->execute(array($_POST['meta_title_swift'],$_POST['meta_keyword_swift'],$_POST['meta_description_swift'],$_POST['home_swift_title'],$_POST['home_swift_description']));

    $success_message = 'Swift Code Section is updated successfully.';
}

if(isset($_POST['form_home_micr'])) {
    $statement = $pdo->prepare("UPDATE tbl_settings SET meta_title_micr=?, meta_keyword_micr=?, meta_description_micr=?, home_micr_title=?, home_micr_description=? WHERE id=1");
	$statement->execute(array($_POST['meta_title_micr'],$_POST['meta_keyword_micr'],$_POST['meta_description_micr'],$_POST['home_micr_title'],$_POST['home_micr_description']));

    $success_message = 'MICR Code Section is updated successfully.';
}
   	// End --- Home Page 
if(isset($_POST['form_ifsc_bank'])) {
 
	$statement = $pdo->prepare("UPDATE tbl_meta SET ifsc_title_bank=?, ifsc_description_bank=?, ifsc_heading_bank=?, ifsc_paragraph_bank=? WHERE id=1");
	$statement->execute(array($_POST['ifsc_title_bank'],$_POST['ifsc_description_bank'],$_POST['ifsc_heading_bank'],$_POST['ifsc_paragraph_bank']));

	$success_message = 'IFSC Code Bank Page Section is updated successfully.';
}

if(isset($_POST['form_ifsc_state'])) {
    	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_meta SET ifsc_title_state=?, ifsc_description_state=?, ifsc_heading_state=?, ifsc_paragraph_state=? WHERE id=1");
	$statement->execute(array($_POST['ifsc_title_state'],$_POST['ifsc_description_state'],$_POST['ifsc_heading_state'],$_POST['ifsc_paragraph_state']));

	$success_message = 'IFSC Code State Page Section is updated successfully.';
}

if(isset($_POST['form_ifsc_district'])) {
    	// updating the database
	$districtment = $pdo->prepare("UPDATE tbl_meta SET ifsc_title_district=?, ifsc_description_district=?, ifsc_heading_district=?, ifsc_paragraph_district=? WHERE id=1");
	$districtment->execute(array($_POST['ifsc_title_district'],$_POST['ifsc_description_district'],$_POST['ifsc_heading_district'],$_POST['ifsc_paragraph_district']));

	$success_message = 'IFSC Code District Page Section is updated successfully.';
} 
if(isset($_POST['form_ifsc_branch'])) {
    	// updating the database
	$branchment = $pdo->prepare("UPDATE tbl_meta SET ifsc_title_branch=?, ifsc_description_branch=?, ifsc_heading_branch=?, ifsc_paragraph_branch=? WHERE id=1");
	$branchment->execute(array($_POST['ifsc_title_branch'],$_POST['ifsc_description_branch'],$_POST['ifsc_heading_branch'],$_POST['ifsc_paragraph_branch']));

	$success_message = 'IFSC Code branch Page Section is updated successfully.';
}

if(isset($_POST['form_micr_bank'])) {
    	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_meta SET micr_title_bank=?, micr_description_bank=?, micr_heading_bank=?, micr_paragraph_bank=? WHERE id=1");
	$statement->execute(array($_POST['micr_title_bank'],$_POST['micr_description_bank'],$_POST['micr_heading_bank'],$_POST['micr_paragraph_bank']));

	$success_message = 'micr Code Bank Page Section is updated successfully.';
}
	// End --- Bank Page 
if(isset($_POST['form_micr_state'])) {
    	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_meta SET micr_title_state=?, micr_description_state=?, micr_heading_state=?, micr_paragraph_state=? WHERE id=1");
	$statement->execute(array($_POST['micr_title_state'],$_POST['micr_description_state'],$_POST['micr_heading_state'],$_POST['micr_paragraph_state']));

	$success_message = 'micr Code State Page Section is updated successfully.';
}

if(isset($_POST['form_micr_district'])) {
    	// updating the database
	$districtment = $pdo->prepare("UPDATE tbl_meta SET micr_title_district=?, micr_description_district=?, micr_heading_district=?, micr_paragraph_district=? WHERE id=1");
	$districtment->execute(array($_POST['micr_title_district'],$_POST['micr_description_district'],$_POST['micr_heading_district'],$_POST['micr_paragraph_district']));

	$success_message = 'micr Code District Page Section is updated successfully.';
} 
if(isset($_POST['form_micr_branch'])) {
    	// updating the database
	$branchment = $pdo->prepare("UPDATE tbl_meta SET micr_title_branch=?, micr_description_branch=?, micr_heading_branch=?, micr_paragraph_branch=? WHERE id=1");
	$branchment->execute(array($_POST['micr_title_branch'],$_POST['micr_description_branch'],$_POST['micr_heading_branch'],$_POST['micr_paragraph_branch']));

	$success_message = 'micr Code branch Page Section is updated successfully.';
}

if(isset($_POST['form_swift_country'])) {
    	// updating the database
	$bankment = $pdo->prepare("UPDATE tb2_meta SET swift_title_country=?, swift_description_country=?, swift_heading_country=?, swift_paragraph_country=? WHERE id=1");
	$bankment->execute(array($_POST['swift_title_country'],$_POST['swift_description_country'],$_POST['swift_heading_country'],$_POST['swift_paragraph_country']));

	$success_message = 'swift Code country Page Section is updated successfully.';
}

if(isset($_POST['form_swift_bank'])) {
    	// updating the database
	$bankment = $pdo->prepare("UPDATE tb2_meta SET swift_title_bank=?, swift_description_bank=?, swift_heading_bank=?, swift_paragraph_bank=? WHERE id=1");
	$bankment->execute(array($_POST['swift_title_bank'],$_POST['swift_description_bank'],$_POST['swift_heading_bank'],$_POST['swift_paragraph_bank']));

	$success_message = 'swift Code bank Page Section is updated successfully.';
}

if(isset($_POST['form_swift_city'])) {
    	// updating the database
	$cityment = $pdo->prepare("UPDATE tb2_meta SET swift_title_city=?, swift_description_city=?, swift_heading_city=?, swift_paragraph_city=? WHERE id=1");
	$cityment->execute(array($_POST['swift_title_city'],$_POST['swift_description_city'],$_POST['swift_heading_city'],$_POST['swift_paragraph_city']));

	$success_message = 'swift Code city Page Section is updated successfully.';
} 
if(isset($_POST['form_swift_branch'])) {
    	// updating the database
	$branchment = $pdo->prepare("UPDATE tb2_meta SET swift_title_branch=?, swift_description_branch=?, swift_heading_branch=?, swift_paragraph_branch=? WHERE id=1");
	$branchment->execute(array($_POST['swift_title_branch'],$_POST['swift_description_branch'],$_POST['swift_heading_branch'],$_POST['swift_paragraph_branch']));

	$success_message = 'swift Code branch Page Section is updated successfully.';
}

if(isset($_POST['form_pin_state'])) {
    	// updating the database
	$districtment = $pdo->prepare("UPDATE tb2_meta SET pin_title_state=?, pin_description_state=?, pin_heading_state=?, pin_paragraph_state=? WHERE id=1");
	$districtment->execute(array($_POST['pin_title_state'],$_POST['pin_description_state'],$_POST['pin_heading_state'],$_POST['pin_paragraph_state']));

	$success_message = 'pin Code state Page Section is updated successfully.';
}

if(isset($_POST['form_pin_district'])) {
    	// updating the database
	$districtment = $pdo->prepare("UPDATE tb2_meta SET pin_title_district=?, pin_description_district=?, pin_heading_district=?, pin_paragraph_district=? WHERE id=1");
	$districtment->execute(array($_POST['pin_title_district'],$_POST['pin_description_district'],$_POST['pin_heading_district'],$_POST['pin_paragraph_district']));

	$success_message = 'pin Code district Page Section is updated successfully.';
}

if(isset($_POST['form_pin_block'])) {
    	// updating the database
	$blockment = $pdo->prepare("UPDATE tb2_meta SET pin_title_block=?, pin_description_block=?, pin_heading_block=?, pin_paragraph_block=? WHERE id=1");
	$blockment->execute(array($_POST['pin_title_block'],$_POST['pin_description_block'],$_POST['pin_heading_block'],$_POST['pin_paragraph_block']));

	$success_message = 'pin Code block Page Section is updated successfully.';
} 
if(isset($_POST['form_pin_office'])) {
    	// updating the database
	$officement = $pdo->prepare("UPDATE tb2_meta SET pin_title_office=?, pin_description_office=?, pin_heading_office=?, pin_paragraph_office=? WHERE id=1");
	$officement->execute(array($_POST['pin_title_office'],$_POST['pin_description_office'],$_POST['pin_heading_office'],$_POST['pin_paragraph_office']));

	$success_message = 'pin Code office Page Section is updated successfully.';
}

if(isset($_POST['form_ifsc'])) {
    	// updating the database
	$officement = $pdo->prepare("UPDATE tbl_meta SET ifsc_title=?, ifsc_description=?, ifsc_heading=?, ifsc_paragraph=? WHERE id=1");
	$officement->execute(array($_POST['ifsc_title'],$_POST['ifsc_description'],$_POST['ifsc_heading'],$_POST['ifsc_paragraph']));

	$success_message = 'ifsc Code Page Section is updated successfully.';
}

if(isset($_POST['form_micr'])) {
    	// updating the database
	$officement = $pdo->prepare("UPDATE tbl_meta SET micr_title=?, micr_description=?, micr_heading=?, micr_paragraph=? WHERE id=1");
	$officement->execute(array($_POST['micr_title'],$_POST['micr_description'],$_POST['micr_heading'],$_POST['micr_paragraph']));

	$success_message = 'micr Code Page Section is updated successfully.';
}
if(isset($_POST['form_swift'])) {
    	// updating the database
	$officement = $pdo->prepare("UPDATE tb2_meta SET swift_title=?, swift_description=?, swift_heading=?, swift_paragraph=? WHERE id=1");
	$officement->execute(array($_POST['swift_title'],$_POST['swift_description'],$_POST['swift_heading'],$_POST['swift_paragraph']));

	$success_message = 'swift Code Page Section is updated successfully.';
}

if(isset($_POST['form_pin'])) {
    	// updating the database
	$officement = $pdo->prepare("UPDATE tb2_meta SET pin_title=?, pin_description=?, pin_heading=?, pin_paragraph=? WHERE id=1");
	$officement->execute(array($_POST['pin_title'],$_POST['pin_description'],$_POST['pin_heading'],$_POST['pin_paragraph']));

	$success_message = 'pin Code Page Section is updated successfully.';
}

if(isset($_POST['form_ifsc_photo'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $ifsc_photo = $row['ifsc_photo'];
            unlink('../assets/uploads/'.$ifsc_photo);
        }

        // updating the data
        $final_name = 'ifsc_photo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET ifsc_photo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'IFSC Share Image is updated successfully.';
        
    }
}

if(isset($_POST['form_micr_photo'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $micr_photo = $row['micr_photo'];
            unlink('../assets/uploads/'.$micr_photo);
        }

        // updating the data
        $final_name = 'micr_photo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET micr_photo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'MICR Share Image is updated successfully.';
        
    }
}

if(isset($_POST['form_pin_photo'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $pin_photo = $row['pin_photo'];
            unlink('../assets/uploads/'.$pin_photo);
        }

        // updating the data
        $final_name = 'pin_photo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET pin_photo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'PIN Code Share Image is updated successfully.';
        
    }
}


if(isset($_POST['form_swift_photo'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $swift_photo = $row['swift_photo'];
            unlink('../assets/uploads/'.$swift_photo);
        }

        // updating the data
        $final_name = 'swift_photo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET swift_photo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Swift Code Share Image is updated successfully.';
        
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>meta</h1>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_meta WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$ifsc_title_bank			= $row['ifsc_title_bank'];
	$ifsc_description_bank		= $row['ifsc_description_bank'];
	$ifsc_heading_bank			= $row['ifsc_heading_bank'];
	$ifsc_paragraph_bank		= $row['ifsc_paragraph_bank'];
	$ifsc_title_state			= $row['ifsc_title_state'];
	$ifsc_description_state		= $row['ifsc_description_state'];
	$ifsc_heading_state			= $row['ifsc_heading_state'];
	$ifsc_paragraph_state		= $row['ifsc_paragraph_state'];
	$ifsc_title_district		= $row['ifsc_title_district'];
	$ifsc_description_district	= $row['ifsc_description_district'];
	$ifsc_heading_district		= $row['ifsc_heading_district'];
	$ifsc_paragraph_district	= $row['ifsc_paragraph_district'];
	$ifsc_title_branch			= $row['ifsc_title_branch'];
	$ifsc_description_branch	= $row['ifsc_description_branch'];
	$ifsc_heading_branch		= $row['ifsc_heading_branch'];
	$ifsc_paragraph_branch		= $row['ifsc_paragraph_branch'];
	$ifsc_keywords_branch		= $row['ifsc_keywords_branch'];
	$micr_title_bank			= $row['micr_title_bank'];
	$micr_description_bank		= $row['micr_description_bank'];
	$micr_heading_bank			= $row['micr_heading_bank'];
	$micr_paragraph_bank		= $row['micr_paragraph_bank'];
	$micr_title_state			= $row['micr_title_state'];
	$micr_description_state		= $row['micr_description_state'];
	$micr_heading_state			= $row['micr_heading_state'];
	$micr_paragraph_state		= $row['micr_paragraph_state'];
	$micr_title_district		= $row['micr_title_district'];
	$micr_description_district	= $row['micr_description_district'];
	$micr_heading_district		= $row['micr_heading_district'];
	$micr_paragraph_district	= $row['micr_paragraph_district'];
	$micr_title_branch			= $row['micr_title_branch'];
	$micr_description_branch	= $row['micr_description_branch'];
	$micr_heading_branch		= $row['micr_heading_branch'];
	$micr_paragraph_branch		= $row['micr_paragraph_branch'];
	$micr_keywords_branch		= $row['micr_keywords_branch'];
	$ifsc_title					= $row['ifsc_title'];
	$ifsc_description			= $row['ifsc_description'];
	$ifsc_heading				= $row['ifsc_heading'];
	$ifsc_paragraph				= $row['ifsc_paragraph'];
	$ifsc_keywords				= $row['ifsc_keywords'];
	$micr_title					= $row['micr_title'];
	$micr_description			= $row['micr_description'];
	$micr_heading				= $row['micr_heading'];
	$micr_paragraph				= $row['micr_paragraph'];
	$micr_keywords				= $row['micr_keywords'];
}
?>
<?php
$statement = $pdo->prepare("SELECT * FROM tb2_meta WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {

	$pin_title_state			= $row['pin_title_state'];
	$pin_description_state		= $row['pin_description_state'];
	$pin_heading_state			= $row['pin_heading_state'];
	$pin_paragraph_state		= $row['pin_paragraph_state'];
	$pin_title_district			= $row['pin_title_district'];
	$pin_description_district	= $row['pin_description_district'];
	$pin_heading_district		= $row['pin_heading_district'];
	$pin_paragraph_district		= $row['pin_paragraph_district'];
	$pin_title_block			= $row['pin_title_block'];
	$pin_description_block		= $row['pin_description_block'];
	$pin_heading_block			= $row['pin_heading_block'];
	$pin_paragraph_block		= $row['pin_paragraph_block'];
	$pin_title_office			= $row['pin_title_office'];
	$pin_description_office		= $row['pin_description_office'];
	$pin_heading_office			= $row['pin_heading_office'];
	$pin_paragraph_office		= $row['pin_paragraph_office'];
	$pin_keywords_office		= $row['pin_keywords_office'];
	$swift_title_country		= $row['swift_title_country'];
	$swift_description_country	= $row['swift_description_country'];
	$swift_heading_country		= $row['swift_heading_country'];
	$swift_paragraph_country	= $row['swift_paragraph_country'];
	$swift_title_bank			= $row['swift_title_bank'];
	$swift_description_bank		= $row['swift_description_bank'];
	$swift_heading_bank			= $row['swift_heading_bank'];
	$swift_paragraph_bank		= $row['swift_paragraph_bank'];
	$swift_title_city			= $row['swift_title_city'];
	$swift_description_city		= $row['swift_description_city'];
	$swift_heading_city			= $row['swift_heading_city'];
	$swift_paragraph_city		= $row['swift_paragraph_city'];
	$swift_title_branch			= $row['swift_title_branch'];
	$swift_description_branch	= $row['swift_description_branch'];
	$swift_heading_branch		= $row['swift_heading_branch'];
	$swift_paragraph_branch		= $row['swift_paragraph_branch'];
	$swift_keywords_branch		= $row['swift_keywords_branch'];
	$pin_title					= $row['pin_title'];
	$pin_description			= $row['pin_description'];
	$pin_heading				= $row['pin_heading'];
	$pin_paragraph				= $row['pin_paragraph'];
	$pin_keywords				= $row['pin_keywords'];
	$swift_title				= $row['swift_title'];
	$swift_description			= $row['swift_description'];
	$swift_heading				= $row['swift_heading'];
	$swift_paragraph			= $row['swift_paragraph'];
	$swift_keywords				= $row['swift_keywords'];
}
?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
$meta_title_home 			= $row['meta_title_home'];
$meta_keyword_home 			= $row['meta_keyword_home'];
$meta_description_home 		= $row['meta_description_home'];
$home_title 				= $row['home_title'];
$home_description 			= $row['home_description'];
$home_content 				= $row['home_content'];
$meta_title_pin 			= $row['meta_title_pin'];
$meta_keyword_pin 			= $row['meta_keyword_pin'];
$meta_description_pin 		= $row['meta_description_pin'];
$home_pin_title 			= $row['home_pin_title'];
$home_pin_description 		= $row['home_pin_description'];
$home_pin_content 			= $row['home_pin_content'];
$meta_title_swift 			= $row['meta_title_swift'];
$meta_keyword_swift 		= $row['meta_keyword_swift'];
$meta_description_swift 	= $row['meta_description_swift'];
$home_swift_title 			= $row['home_swift_title'];
$home_swift_description 	= $row['home_swift_description'];
$home_swift_content 		= $row['home_swift_content'];
$meta_title_micr 			= $row['meta_title_micr'];
$meta_keyword_micr 			= $row['meta_keyword_micr'];
$meta_description_micr 		= $row['meta_description_micr'];
$home_micr_title 			= $row['home_micr_title'];
$home_micr_description 		= $row['home_micr_description'];
$home_micr_content 			= $row['home_micr_content'];
$ifsc_photo 				= $row['ifsc_photo'];
$micr_photo 				= $row['micr_photo'];
$pin_photo 					= $row['pin_photo'];
$swift_photo 				= $row['swift_photo'];

}
?>
<section class="content" style="min-height:auto;margin-bottom: -30px;">
	<div class="row">
		<div class="col-md-12">
			<?php if($error_message): ?>
			<div class="callout callout-danger">
			
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			
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
						<li class="active"><a href="#tab_1" data-toggle="tab">IFSC Code Meta</a></li>
						<li><a href="#tab_2" data-toggle="tab">MICR Code Meta</a></li>
						<li><a href="#tab_3" data-toggle="tab">PIN Code Meta</a></li>
						<li><a href="#tab_4" data-toggle="tab">Swift Code Meta </a></li>
						
						
					</ul>
					<div class="tab-content">
          				
							<div class="tab-pane active" id="tab_1">Not available in free version. Buy now pro version to activate this feature.</div>
						
          				<div class="tab-pane" id="tab_2">Not available in free version. Buy now pro version to activate this feature.</div>

          			<div class="tab-pane" id="tab_3"> Edit feature not available in free version. Buy now pro version to activate this feature.
					<h3>PIN Code Home Page Meta Section</h3>
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
	                                <div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="meta_title_pin" class="form-control" value="<?php echo $meta_title_pin ?>">
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Keyword </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="meta_keyword_pin" style="height:100px;"><?php echo $meta_keyword_pin ?></textarea>
										</div>
									</div>	
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="meta_description_pin" style="height:100px;"><?php echo $meta_description_pin ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Home Page Title </label>
										<div class="col-sm-9">
										<input type="text" name="home_pin_title" class="form-control" value="<?php echo $home_pin_title ?>">
											
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Home Page Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="home_pin_description" id="editor16"><?php echo $home_pin_description ?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
                                </div>
                            </div>
                            </form>
<h3>PIN State Page Meta Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="pin_title_state" class="form-control" value="<?php echo $pin_title_state ?>">
										</div>
									</div>		
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_description_state" style="height:100px;"><?php echo $pin_description_state ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">state Page Heading h1 </label>
										<div class="col-sm-9">
										<input type="text" name="pin_heading_state" class="form-control" value="<?php echo $pin_heading_state ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">state Page After Title Paragraph </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_paragraph_state" id="editor13"><?php echo $pin_paragraph_state ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>					


<h3>PIN Code district Page Meta Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="pin_title_district" class="form-control" value="<?php echo $pin_title_district ?>">
										</div>
									</div>		
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_description_district" style="height:100px;"><?php echo $pin_description_district ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Heading h1 </label>
										<div class="col-sm-9">
										<input type="text" name="pin_heading_district" class="form-control" value="<?php echo $pin_heading_district ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">After Title Paragraph </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_paragraph_district" id="editor14"><?php echo $pin_paragraph_district ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>
<h3>PIN Code Block Page Meta Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="pin_title_block" class="form-control" value="<?php echo $pin_title_block ?>">
										</div>
									</div>		
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_description_block" style="height:100px;"><?php echo $pin_description_block ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Heading h1 </label>
										<div class="col-sm-9">
										<input type="text" name="pin_heading_block" class="form-control" value="<?php echo $pin_heading_block ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">After Title Paragraph </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_paragraph_block" id="editor15"><?php echo $pin_paragraph_block ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>
							
							
<h3>PIN Code Post office Page Meta Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="pin_title_office" class="form-control" value="<?php echo $pin_title_office ?>">
										</div>
									</div>		
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_description_office" style="height:100px;"><?php echo $pin_description_office ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Heading h1 </label>
										<div class="col-sm-9">
										<input type="text" name="pin_heading_office" class="form-control" value="<?php echo $pin_heading_office ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">After Title Paragraph </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_paragraph_office" id="editor17"><?php echo $pin_paragraph_office ?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>							
							
<h3>Single PIN Code Details Page Meta Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="pin_title" class="form-control" value="<?php echo $pin_title ?>">
										</div>
									</div>		
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_description" style="height:100px;"><?php echo $pin_description ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Heading h1 </label>
										<div class="col-sm-9">
										<input type="text" name="pin_heading" class="form-control" value="<?php echo $pin_heading ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">After Title Paragraph </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="pin_paragraph" id="editor18"><?php echo $pin_paragraph ?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>							
<h3>Social Media Share Images</h3>
          					<table class="table table-bordered">
								<tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Pin code Pages Photo</h4>
                                        <p>
                                            <img src="<?php echo BASE_URL.'assets/uploads/'.$pin_photo; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change pin Page image</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;">
                                    </td>
                                    </form>
                                </tr>
								
          					</table>							
          				</div>
						
						<div class="tab-pane" id="tab_4">Not available in free version. Buy now pro version to activate this feature.</div>
						
						<div class="tab-pane" id="tab_5">

          				</div>
						
						<div class="tab-pane" id="tab_6">

							
						</div>
						
						<div class="tab-pane" id="tab_7">	
							
						
							
          				</div>



          			</div>
				</div>

			
		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>