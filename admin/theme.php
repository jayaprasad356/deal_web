<?php require_once('header.php'); ?>

<?php


if(isset($_POST['form_body'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET theme_bg_color=?, theme_text_color=?, theme_hover_color=?, theme_border_color=?, widget_bg_color=?,theme_color=? WHERE id=1");
    $statement->execute(array($_POST['theme_bg_color'],$_POST['theme_text_color'],$_POST['theme_hover_color'],$_POST['theme_border_color'],$_POST['widget_bg_color'],$_POST['theme_color']));

    $success_message = 'Body settings is updated successfully.';
}


if(isset($_POST['form_theme'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET select_style=?, theme_width=?, sidebar_status=? WHERE id=1");
    $statement->execute(array($_POST['select_style'],$_POST['theme_width'],$_POST['sidebar_status']));

    $success_message = 'Theme settings is updated successfully.';
}

if(isset($_POST['form_header'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET header_bg_color=?, header_text_color=?, header_link_color=?, header_link_hover_color=?, header_style=? WHERE id=1");
    $statement->execute(array($_POST['header_bg_color'],$_POST['header_text_color'],$_POST['header_link_color'],$_POST['header_link_hover_color'],$_POST['header_style']));

    $success_message = 'Header settings is updated successfully.';
}

if(isset($_POST['form_sidebar'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET sidebar_bg_color=?, sidebar_text_color=?, sidebar_link_color=?, sidebar_link_hover_color=?,sidebar_widget_status=?,sidebar_widget_title=?,sidebar_widget_code=? WHERE id=1");
    $statement->execute(array($_POST['sidebar_bg_color'],$_POST['sidebar_text_color'],$_POST['sidebar_link_color'],$_POST['sidebar_link_hover_color'],$_POST['sidebar_widget_status'],$_POST['sidebar_widget_title'],$_POST['sidebar_widget_code']));

    $success_message = 'Sidebar settings is updated successfully.';
}

if(isset($_POST['form_copyright'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET copyright_bg_color=?, copyright_text_color=?, copyright_link_color=?, copyright_link_hover_color=? , copyright_text=? WHERE id=1");
    $statement->execute(array($_POST['copyright_bg_color'],$_POST['copyright_text_color'],$_POST['copyright_link_color'],$_POST['copyright_link_hover_color'],$_POST['copyright_text']));

    $success_message = 'Copyright settings is updated successfully.';
}
if(isset($_POST['form_footer_content'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET footer_title_1=?, footer_title_2=?, footer_title_3=?, footer_content_1=? , footer_content_2=?, footer_content_3=? WHERE id=1");
    $statement->execute(array($_POST['footer_title_1'],$_POST['footer_title_2'],$_POST['footer_title_3'],$_POST['footer_content_1'],$_POST['footer_content_2'],$_POST['footer_content_3']));

    $success_message = 'Footer settings is updated successfully.';
}
if(isset($_POST['form_font'])) {
    $statement = $pdo->prepare("UPDATE tbl_theme SET font_size=?, font_style=?, font_family=?, h1_size=?, h2_size=? WHERE id=1");
    $statement->execute(array($_POST['font_size'],$_POST['font_style'],$_POST['font_family'],$_POST['h1_size'],$_POST['h2_size']));

    $success_message = 'Font settings is updated successfully.';
}

if(isset($_POST['form_footer'])) {

    $valid = 1;

    $path = $_FILES['footer_photo']['name'];
    $path_tmp = $_FILES['footer_photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_theme WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $footer_photo = $row['footer_photo'];
                unlink('../assets/uploads/'.$footer_photo);
            }

            // updating the data
            $final_name = 'footerphoto'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_theme SET footer_status=?,footer_bg_color=?,footer_photo=?,footer_text_color=?,footer_link_color=?,footer_link_hover_color=? WHERE id=1");
            $statement->execute(array($_POST['footer_status'],$_POST['footer_bg_color'],$final_name,$_POST['footer_text_color'],$_POST['footer_link_color'],$_POST['footer_link_hover_color']));

        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_theme SET footer_status=?,footer_bg_color=?,footer_text_color=?,footer_link_color=?,footer_link_hover_color=? WHERE id=1");
            $statement->execute(array($_POST['footer_status'],$_POST['footer_bg_color'],$_POST['footer_text_color'],$_POST['footer_link_color'],$_POST['footer_link_hover_color']));
        }

        $success_message = 'Footer Settings is updated successfully.';
        
    }
}

?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Theme Settings</h1>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_theme WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$theme_color					= $row['theme_color'];
	$theme_bg_color					= $row['theme_bg_color'];
	$theme_text_color				= $row['theme_text_color'];
	$theme_link_color				= $row['theme_link_color'];
	$theme_hover_color				= $row['theme_hover_color'];
	$theme_border_color				= $row['theme_border_color'];
	$widget_bg_color				= $row['widget_bg_color'];
	$select_style					= $row['select_style'];
	$theme_width					= $row['theme_width'];
	$header_style					= $row['header_style'];
	$header_bg_color				= $row['header_bg_color'];
	$header_text_color				= $row['header_text_color'];
	$header_link_color				= $row['header_link_color'];
	$header_link_hover_color		= $row['header_link_hover_color'];
	$footer_status					= $row['footer_status'];
	$footer_bg_color				= $row['footer_bg_color'];
	$footer_photo					= $row['footer_photo'];
	$footer_text_color				= $row['footer_text_color'];
	$footer_link_color				= $row['footer_link_color'];
	$footer_link_hover_color		= $row['footer_link_hover_color'];
	$sidebar_status					= $row['sidebar_status'];
	$copyright_bg_color				= $row['copyright_bg_color'];
	$copyright_text_color			= $row['copyright_text_color'];
	$copyright_link_color			= $row['copyright_link_color'];
	$copyright_link_hover_color		= $row['copyright_link_hover_color'];
	$font_size						= $row['font_size'];
	$font_style						= $row['font_style'];
	$font_family					= $row['font_family'];
	$h1_size						= $row['h1_size'];
	$h2_size						= $row['h2_size'];
	$footer_title_1					= $row['footer_title_1'];
	$footer_title_2					= $row['footer_title_2'];
	$footer_title_3					= $row['footer_title_3'];
	$footer_content_1				= $row['footer_content_1'];
	$footer_content_2				= $row['footer_content_2'];
	$footer_content_3				= $row['footer_content_3'];
	$copyright_text					= $row['copyright_text'];
	
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
					
					<div class="tab-content">
							<h3>Footer Copyright</h3>
          					<form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                   
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Background Color</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="copyright_bg_color" class="form-control jscolor" value="<?php echo $copyright_bg_color; ?>">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Text Color </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="copyright_text_color" class="form-control jscolor" value="<?php echo $copyright_text_color; ?>">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Links Color </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="copyright_link_color" class="form-control jscolor" value="<?php echo $copyright_link_color; ?>">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Links Color on mouse over </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="copyright_link_hover_color" class="form-control jscolor" value="<?php echo $copyright_link_hover_color; ?>">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Footer - Copyright Text</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="copyright_text" class="form-control" value="<?php echo $copyright_text; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_copyright">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            





          			</div>
				</div>

			
		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>