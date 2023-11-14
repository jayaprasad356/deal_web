<?php require_once('header.php'); ?>
<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    $title = $_POST['title'];
    $description = $_POST['description'];

    if ($valid == 1) {
        // Save the data into the database
        $statement = $pdo->prepare("INSERT INTO tbl_notifications (title, description) VALUES (?, ?)");
        $statement->execute([$title, $description]);

        $success_message = 'notifications added successfully.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Notifications</h1>
    </div>
    <div class="content-header-right">
        <a href="notifications.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($error_message): ?>
                <div class="callout callout-danger">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="callout callout-success">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                    <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title<span>*</span></label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" name="title" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description<span>*</span></label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" name="description" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
