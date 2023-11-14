<?php require_once('header.php'); ?>
<?php

if (isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if ($valid == 1) {
        // Get the existing data from the database
        $statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE categories_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $existing_photo = $row['photo'];
        }

        if ($path == '') {
            // No new photo, update other fields
            $statement = $pdo->prepare("UPDATE tbl_categories SET full_name=? WHERE categories_id=?");
            $statement->execute(array($_POST['full_name'], $_REQUEST['id']));
        } else {
            // New photo uploaded, delete existing photo and update the data
            if ($existing_photo != '') {
                unlink('../assets/uploads/' . $existing_photo);
            }

            $final_name = 'user-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);


            $statement = $pdo->prepare("UPDATE tbl_categories SET full_name=?, photo=? WHERE categories_id=?");
            $statement->execute(array($_POST['full_name'], $final_name, $_REQUEST['id']));
        }

        unset($_POST['full_name']);

        $success_message = 'Categories is updated successfully.';
    }
}
?>
<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check if the id is valid
    $statement = $pdo->prepare("SELECT * FROM tbl_categories WHERE categories_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>


<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Categories</h1>
    </div>
    <div class="content-header-right">
        <a href="categories.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>
<?php
foreach ($result as $row) {
    $full_name = $row['full_name'];
    $photo = $row['photo'];
}
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if ($error_message): ?>
                <div class="callout callout-danger">
                    <h4>Please correct the following errors:</h4>
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="callout callout-success">
                    <h4>Success:</h4>
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
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
                                if ($photo == '') {
                                    echo '<img src="../assets/uploads/no-photo.jpg" style="width:150px;">';
                                } else {
                                    echo '<img src="../assets/uploads/' . $photo . '"  style="width:150px;">';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">New Photo</label>
                            <div class="col-sm-6" style="padding-top:6px;">
                                <input type="file" name="photo">
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
    </div>
</section>

<?php require_once('footer.php'); ?>
