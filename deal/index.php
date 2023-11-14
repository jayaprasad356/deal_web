<?php require_once('header.php'); ?>

<?php


// Define your database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "deal";

// Create a database connection
$db = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
<section class="content-header">
  <h1>Dashboard</h1>
</section>



<section class="content">

  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <div class="info-box-content bg-green">
          <span class="info-box-text">Total Users</span>
          <h3><?php
                        $sql = "SELECT COUNT(id) as user_count FROM tbl_user";
                        $result = $db->query($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            $user_count = $row['user_count'];
                        } else {
                            // Handle the query error as needed
                            $user_count = 0; // Set a default value or an error message
                        }
                        
                             ?></h3>
                             <span class="info-box-number"><?php echo $user_count; ?></span>
        </div>
		<div class="info-box-content  bg-aqua">
          <span class="info-box-text"><a href="user.php" style="color:#fff;">View All Users <i class="fa fa-arrow-circle-right"></i></a></span>
        </div>
      </div>
    </div>
</section>

<?php require_once('footer.php'); ?>