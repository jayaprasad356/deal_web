<?php require_once('header.php'); ?>
<?php
include("../config/config.php");
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
    
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <div class="info-box-content bg-green">
          <span class="info-box-text">Total Items</span>
          <h3><?php
                        $sql = "SELECT COUNT(items_id) as items_count FROM tbl_items";
                        $result = $db->query($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            $items_count = $row['tbl_items'];
                        } else {
                            // Handle the query error as needed
                            $items_count = 0; // Set a default value or an error message
                        }
                        
                             ?></h3>
                             <span class="info-box-number"><?php echo $items_count; ?></span>
        </div>
		<div class="info-box-content  bg-aqua">
          <span class="info-box-text"><a href="item.php" style="color:#fff;">View All Items <i class="fa fa-arrow-circle-right"></i></a></span>
        </div>
      </div>
    </div>


    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <div class="info-box-content bg-green">
          <span class="info-box-text">Total Categories</span>
          <h3><?php
                        $sql = "SELECT COUNT(categories_id) as categories_count FROM tbl_categories";
                        $result = $db->query($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            $categories_count = $row['categories_count'];
                        } else {
                            // Handle the query error as needed
                            $categories_count = 0; // Set a default value or an error message
                        }
                        
                             ?></h3>
                             <span class="info-box-number"><?php echo $categories_count; ?></span>
        </div>
		<div class="info-box-content  bg-aqua">
          <span class="info-box-text"><a href="categories.php" style="color:#fff;">View All Categories <i class="fa fa-arrow-circle-right"></i></a></span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <div class="info-box-content bg-green">
          <span class="info-box-text">Total Sub Categories</span>
          <h3><?php
                        $sql = "SELECT COUNT(subcategories_id) as subcategories_count FROM tbl_subcategories";
                        $result = $db->query($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            $subcategories_count = $row['subcategories_count'];
                        } else {
                            // Handle the query error as needed
                            $subcategories_count = 0; // Set a default value or an error message
                        }
                        
                             ?></h3>
                             <span class="info-box-number"><?php echo $subcategories_count; ?></span>
        </div>
		<div class="info-box-content  bg-aqua">
          <span class="info-box-text"><a href="subcategories.php" style="color:#fff;">View All Sub Categories <i class="fa fa-arrow-circle-right"></i></a></span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <div class="info-box-content bg-green">
          <span class="info-box-text">Total ISD Code</span>
          <h3><?php
                        $sql = "SELECT COUNT(isd_code_id) as codes_count FROM tbl_isd_code";
                        $result = $db->query($sql);
                        if ($result) {
                            $row = $result->fetch_assoc();
                            $codes_count = $row['codes_count'];
                        } else {
                            // Handle the query error as needed
                            $codes_count = 0; // Set a default value or an error message
                        }
                        
                             ?></h3>
                             <span class="info-box-number"><?php echo $codes_count; ?></span>
        </div>
		<div class="info-box-content  bg-aqua">
          <span class="info-box-text"><a href="isd_code.php" style="color:#fff;">View All ISD Code<i class="fa fa-arrow-circle-right"></i></a></span>
        </div>
      </div>
    </div>

  
    
  


</section>

<?php require_once('footer.php'); ?>