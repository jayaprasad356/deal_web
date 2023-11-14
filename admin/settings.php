<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

	$path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

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
    		$logo = $row['logo'];
    		unlink('../assets/uploads/'.$logo);
    	}

    	// updating the data
    	$final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
		$statement = $pdo->prepare("UPDATE tbl_settings SET logo=? WHERE id=1");
		$statement->execute(array($final_name));

        $success_message = 'Logo is updated successfully.';
    	
    }
}
if(isset($_POST['mobile_logo'])) {
	$valid = 1;

	$path = $_FILES['mobile_photo_logo']['name'];
    $path_tmp = $_FILES['mobile_photo_logo']['tmp_name'];

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
    		$mobile_logo = $row['mobile_logo'];
    		unlink('../assets/uploads/'.$mobile_logo);
    	}

    	// updating the data
    	$final_name = 'mobile_logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
		$statement = $pdo->prepare("UPDATE tbl_settings SET logo_width=?, logo_height=?, mobile_logo=? WHERE id=1");
		$statement->execute(array($_POST['logo_width'],$_POST['logo_height'],$final_name));

        $success_message = 'Mobile Logo is updated successfully.';
    	
    }
}
if(isset($_POST['form2'])) {
	$valid = 1;

	$path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

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
    		$favicon = $row['favicon'];
    		unlink('../assets/uploads/'.$favicon);
    	}

    	// updating the data
    	$final_name = 'favicon'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        // updating the database
		$statement = $pdo->prepare("UPDATE tbl_settings SET favicon=? WHERE id=1");
		$statement->execute(array($final_name));

        $success_message = 'Favicon is updated successfully.';
    	
    }
}

if(isset($_POST['sitename'])) {
	
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET site_title=?, logo_status=? WHERE id=1");
	$statement->execute(array($_POST['site_title'],$_POST['logo_status']));

	$success_message = 'Site Name settings is updated successfully.';
    
}
if(isset($_POST['form3'])) {
	
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET contact_address=?, contact_email=?, contact_phone=?, contact_map_iframe=?,author_name=? WHERE id=1");
	$statement->execute(array($_POST['contact_address'],$_POST['contact_email'],$_POST['contact_phone'],$_POST['contact_map_iframe'], $_POST['author_name']));

	$success_message = 'General content settings is updated successfully.';
    
}

if(isset($_POST['form4'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET receive_email=?, receive_email_subject=?,receive_email_thank_you_message=? WHERE id=1");
	$statement->execute(array($_POST['receive_email'],$_POST['receive_email_subject'],$_POST['receive_email_thank_you_message']));

	$success_message = 'Contact form settings information is updated successfully.';
}


if(isset($_POST['form5'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET recent_news_footer=?, popular_news_footer=?, recent_news_sidebar=?, popular_news_sidebar=?, recent_news_home_page=? WHERE id=1");
	$statement->execute(array($_POST['recent_news_footer'],$_POST['popular_news_footer'],$_POST['recent_news_sidebar'],$_POST['popular_news_sidebar'],$_POST['recent_news_home_page']));

	$success_message = 'Sidebar settings is updated successfully.';
}


if(isset($_POST['form8'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET mod_rewrite=? WHERE id=1");
	$statement->execute(array($_POST['mod_rewrite']));

	$success_message = 'Mod Rewrite settings is updated successfully.';
}

if(isset($_POST['form9'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET news_sidebar_status=?, pin_sidebar_status=?, ifsc_sidebar_status=?, swift_sidebar_status=?, sidebar_widget_status=?, sidebar_widget_title=?,sidebar_widget_code=? WHERE id=1");
	$statement->execute(array($_POST['news_sidebar_status'],$_POST['pin_sidebar_status'],$_POST['ifsc_sidebar_status'],$_POST['swift_sidebar_status'],$_POST['sidebar_widget_status'],$_POST['sidebar_widget_title'],$_POST['sidebar_widget_code']));

	$success_message = 'Sidebar settings is updated successfully.';
} 

 

if(isset($_POST['form7'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET google=?, bing=?, yandex=? WHERE id=1");
	$statement->execute(array($_POST['google'],$_POST['bing'],$_POST['yandex']));

	$success_message = 'Webmaster Tools settings is updated successfully.';
}
if(isset($_POST['form10'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE tbl_settings SET footer_code=?, header_code=? WHERE id=1");
	$statement->execute(array($_POST['footer_code'],$_POST['header_code']));

	$success_message = 'Custom Code settings is updated successfully.';
}

?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Settings</h1>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$logo                            = $row['logo'];
	$site_title						 = $row['site_title'];
	$logo_status					 = $row['logo_status'];
	$mobile_logo					 = $row['mobile_logo'];
	$logo_width                      = $row['logo_width'];
	$logo_height                     = $row['logo_height'];
	$favicon                         = $row['favicon'];
	$footer_logo					 = $row['footer_logo'];
	$author_name					 = $row['author_name'];
	$contact_address                 = $row['contact_address'];
	$contact_email                   = $row['contact_email'];
	$contact_phone                   = $row['contact_phone'];
	$contact_map_iframe              = $row['contact_map_iframe'];
	$receive_email                   = $row['receive_email'];
	$receive_email_subject           = $row['receive_email_subject'];
	$receive_email_thank_you_message = $row['receive_email_thank_you_message'];
	$recent_news_footer				 = $row['recent_news_footer'];
	$popular_news_footer 			 = $row['popular_news_footer'];
	$recent_news_sidebar       		 = $row['recent_news_sidebar'];
	$popular_news_sidebar     		 = $row['popular_news_sidebar'];
	$recent_news_home_page    		 = $row['recent_news_home_page'];
	$news_sidebar_status             = $row['news_sidebar_status'];
	$ifsc_sidebar_status             = $row['ifsc_sidebar_status'];
	$pin_sidebar_status              = $row['pin_sidebar_status'];
	$swift_sidebar_status            = $row['swift_sidebar_status'];
	$sidebar_widget_status			= $row['sidebar_widget_status'];
	$sidebar_widget_title			= $row['sidebar_widget_title'];
	$sidebar_widget_code			= $row['sidebar_widget_code'];
	$google       					 = $row['google'];
	$bing         					 = $row['bing'];
	$yandex          				 = $row['yandex'];
	$footer_code			         = $row['footer_code'];
	$header_code          			 = $row['header_code'];
	$mod_rewrite                     = $row['mod_rewrite'];

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
						<li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
						<li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
						<li><a href="#tab_3" data-toggle="tab">General Content</a></li>
						<li><a href="#tab_4" data-toggle="tab">Email Settings</a></li>
						<li><a href="#tab_5" data-toggle="tab">News</a></li>
						<li><a href="#tab_9" data-toggle="tab">Sidebar</a></li>
						<li><a href="#tab_8" data-toggle="tab">Mod Rewrite</a></li>
                        <li><a href="#tab_7" data-toggle="tab">Webmaster</a></li>
						<li><a href="#tab_10" data-toggle="tab">Custom Code</a></li>
						
					</ul>
					<div class="tab-content">
          				<div class="tab-pane active" id="tab_1">


          					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          					<div class="box box-info">
								<div class="box-body">
								<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Site Title</label>
							            <div class="col-sm-6">
							                <input class="form-control" type="text" name="site_title" value="<?php echo $site_title; ?>">
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Show on Logo? </label>
										<div class="col-sm-6" style="padding-top:7px;">
											<select name="logo_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($logo_status == 'Show') {echo 'selected';} ?>>Show Logo</option>
                                                <option value="Hide" <?php if($logo_status == 'Hide') {echo 'selected';} ?>>Show Site Title</option>
                                            </select>
										</div>
									</div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="sitename">Update</button>
										</div>
									</div>
									<hr>
								<h3>Logo</h3>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label" style="padding-top:20px;">Existing Photo</label>
							            <div class="col-sm-6">
							                <img src="../assets/uploads/<?php echo $logo; ?>" class="existing-photo" style="height:80px;">
							            </div>
							        </div>

									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_logo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form1">Update Logo</button>
										</div>
									</div>
									<hr>
							<h3>Mobile Logo</h3>		
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-4">
							                <span style="padding:10px; background-color: #ddd;"><img src="../assets/uploads/<?php echo $mobile_logo; ?>" class="existing-photo"></span>
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Logo Width</label>
										<div class="col-sm-2">
											<input class="form-control" type="text" name="logo_width" value="<?php echo $logo_width; ?>">
										</div>
										<label for="" class="col-sm-2 control-label">Logo Height</label>
										<div class="col-sm-1">
											<input class="form-control" type="text" name="logo_height" value="<?php echo $logo_height; ?>">
										</div>
									</div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="mobile_photo_logo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="mobile_logo">Update Logo</button>
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
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="../assets/uploads/<?php echo $favicon; ?>" class="existing-photo" style="height:40px;">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_favicon">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form2">Update Favicon</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>
          				<div class="tab-pane" id="tab_3">

							<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Contact Address </label>
										<div class="col-sm-6">
											<textarea class="form-control" name="contact_address" style="height:140px;"><?php echo $contact_address; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Author Name  </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="author_name" value="<?php echo $author_name; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Contact Email </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="contact_email" value="<?php echo $contact_email; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Contact Phone Number </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="contact_phone" value="<?php echo $contact_phone; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Contact Map iFrame </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="contact_map_iframe" style="height:100px;"><?php echo $contact_map_iframe; ?></textarea>
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

          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Email Address <span>*</span></label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="receive_email" value="<?php echo $receive_email; ?>">
										</div>
									</div>									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Email Subject <span>*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="receive_email_subject" value="<?php echo $receive_email_subject; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Thank you message <span>*</span></label>
										<div class="col-sm-9">
											<textarea class="form-control" name="receive_email_thank_you_message"><?php echo $receive_email_thank_you_message; ?></textarea>
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

          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-4 control-label">Footer (How many recent news?)<span>*</span></label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="recent_news_footer" value="<?php echo $recent_news_footer; ?>">
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-4 control-label">Footer (How many popular news?)<span>*</span></label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="popular_news_footer" value="<?php echo $popular_news_footer; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-4 control-label">Sidebar (How many recent news?)<span>*</span></label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="recent_news_sidebar" value="<?php echo $recent_news_sidebar; ?>">
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-4 control-label">Sidebar (How many popular news?)<span>*</span></label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="popular_news_sidebar" value="<?php echo $popular_news_sidebar; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-4 control-label">Home Page (How many recent news?)<span>*</span></label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="recent_news_home_page" value="<?php echo $recent_news_home_page; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-4 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form5">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>


          				</div>

          				<div class="tab-pane" id="tab_8">
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Mode Rewrite </label>
										<div class="col-sm-4">
											<select name="mod_rewrite" class="form-control" style="width:auto;">
												<option value="Off" <?php if($mod_rewrite == 'Off'){echo 'selected';} ?>>Off</option>
												<option value="On" <?php if($mod_rewrite == 'On'){echo 'selected';} ?>>On</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form8">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>



          				<div class="tab-pane" id="tab_9">
						<h3>Sidebar Section</h3>
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
	                                
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Show on Recent News? </label>
										<div class="col-sm-6" style="padding-top:7px;">
											<select name="news_sidebar_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($news_sidebar_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($news_sidebar_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Show on IFSC Code Popular Bank? </label>
										<div class="col-sm-6" style="padding-top:7px;">
											<select name="ifsc_sidebar_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($ifsc_sidebar_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($ifsc_sidebar_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Show on Swift Code Popular Country? </label>
										<div class="col-sm-6" style="padding-top:7px;">
											<select name="swift_sidebar_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($swift_sidebar_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($swift_sidebar_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Show on PIN Code State? </label>
										<div class="col-sm-6" style="padding-top:7px;">
											<select name="pin_sidebar_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($pin_sidebar_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($pin_sidebar_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
										</div>
									</div>
									<h3>Add Custom widget</h3>
									<div class="form-group">
                                        <label for="" class="col-sm-3 control-label">widget Title </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="sidebar_widget_title" class="form-control" value="<?php echo $sidebar_widget_title; ?>">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Custom Code</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="sidebar_widget_code" style="height:100px;"><?php echo $sidebar_widget_code ?></textarea>
                                        </div>
                                    </div>
									<div class="form-group">
							            <label for="" class="col-sm-3 control-label">Custom Widget Show? </label>
							            <div class="col-sm-6">
										<select name="sidebar_widget_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($sidebar_widget_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($sidebar_widget_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
							                
							            </div>
							        </div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form9">Update</button>
										</div>
									</div>
                                </div>
                            </div>
                            </form>
          					
          				</div>
<div class="tab-pane" id="tab_11">
<h3>Newsletter Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                 <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Title </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="newsletter_title" class="form-control" value="<?php echo $newsletter_title; ?>">
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Newsletter Text</label>
                                        <div class="col-sm-8">
                                            <textarea name="newsletter_text" class="form-control" cols="30" rows="10" style="height: 120px;"><?php echo $newsletter_text; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Existing Newsletter Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $newsletter_photo; ?>" class="existing-photo" style="height:180px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">New Newsletter Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="newsletter_photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Status </label>
                                        <div class="col-sm-2">
                                            <select name="newsletter_status" class="form-control" style="width:auto;">
                                                <option value="Show" <?php if($newsletter_status == 'Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($newsletter_status == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_newsletter">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
							</div>

                        <div class="tab-pane" id="tab_7">
						<h3>Webmaster Section</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
										<label for="" class="col-sm-3 control-label">Google verification code </label>
										<div class="col-sm-8">
											<input type="text" name="google" class="form-control" placeholder="Example: IfnY5P98546Z2UwUFp3NZGpOBatX5Z7cJ6e6Mo-bSEU" value="<?php echo $google ?>"><br>
											<p>Get your Google verification code in <a target="_blank" href="https://www.google.com/webmasters/verification/verification?hl=en&amp;tid=alternate&amp;siteUrl=<?php echo BASE_URL; ?>" rel="noopener noreferrer">Google Search Console</a>.</p>
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Bing verification code </label>
										<div class="col-sm-8">
											<input type="text" name="bing" placeholder="Example: 803B1F8A4C8653171A0DC9EC0E9749F9" class="form-control" value="<?php echo $bing ?>"><br>
											<p>Get your Bing verification code in <a target="_blank" href="https://www.bing.com/toolbox/webmaster/#/Dashboard/?url=<?php echo BASE_URL; ?>" rel="noopener noreferrer">Bing Webmaster Tools</a>.</p>
										</div>
									</div>	
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Yandex verification code </label>
										<div class="col-sm-8">
											<input type="text" name="yandex" class="form-control" placeholder="Example: 4024aaeb725432e0" value="<?php echo $yandex ?>"><br>
											<p>Get your Yandex verification code in <a target="_blank" href="https://webmaster.yandex.com/sites/add/" rel="noopener noreferrer">Yandex Webmaster Tools</a>.</p>
										</div>
									</div>	
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form7">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>

						<div class="tab-pane" id="tab_10">
							<h3>Custom Code Section</h3>
          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Header Custom Code </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="header_code" style="height:100px;"><?php echo $header_code ?></textarea>
											<br>
										<p><span class="extra-text">Will add to the &lt;head&gt; tag. Useful if you need to add additional codes such as CSS or JS.				</span></p>
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Footer Custom Code </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="footer_code" style="height:100px;"><?php echo $footer_code ?></textarea>
											<br>
										<p><span class="extra-text">Will add after opening the &lt;body&gt; tag.				</span></p>
										</div>
									</div>	
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form10">Update</button>
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