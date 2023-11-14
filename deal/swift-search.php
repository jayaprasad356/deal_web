<?php require_once('header.php'); ?>
<script type="text/javascript">
	function search1() {

	    var sea=document.getElementById("search").value;

            if (sea==null || sea=="")
            {
                   alert("Search cannot be blank");
            }
            else
            {
                   window.location.href = "swift-search.php?sea="+sea;
            }
	}	
</script>
<section class="content-header">
	<div class="content-header-left">
		<h1>Search by: </h1>
	</div>
	 <div class="form-inline col-xs-4">
     <input type="text" class="form-control mr-sm-2" value="<?php echo $sea = $_GET['sea']; ?>" id="search" name="search" placeholder="Search...">
		    
			    <button onclick="search1()" class="btn my-2 my-sm-0 btn-primary">Search</button>
  </div>
		
	<div class="content-header-right">
		<a href="swift-add.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>

    <!-- Main content -->
<section class="content">

	<div class="row">
	  <div class="col-md-12">
	  <div class="box box-info">

				<div class="box-body table-responsive">
    <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>

		  <th>Bank Name</th>
		  <th>Swift Code</th>
		  <th>Branch</th>
		  <th>City</th>
		  <th>Address</th>
		  <th>Country</th>
		  <th>Country Code</th>
		 
		  <th>Update</th>
		  
                </tr>
                </thead>
                <tbody>

<?php if (isset($_GET['page']) && $_GET['page']!="") {
	$page = $_GET['page'];
	} else {
		$page = 1;
        }

	$total_records_per_page = 150;
    $offset = ($page-1) * $total_records_per_page;
	$previous_page = $page - 1;
	$next_page = $page + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($dbconn,"SELECT COUNT(*) As total_records FROM `swift_details` WHERE bank LIKE '%$sea%' OR swift_code LIKE '%$sea%' OR branch LIKE '%$sea%'  OR city LIKE '%$sea%'  OR address LIKE '%$sea%' OR country LIKE '%$sea%'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($dbconn,"SELECT * FROM `swift_details` WHERE bank LIKE '%$sea%' OR swift_code LIKE '%$sea%' OR branch LIKE '%$sea%' OR city LIKE '%$sea%'  OR address LIKE '%$sea%' OR country LIKE '%$sea%' LIMIT $offset, $total_records_per_page");
    while($row = mysqli_fetch_array($result)){
		echo "<tr>
		

			  <td>".$row['bank']."</td>
	 		  <td>".$row['swift_code']."</td>
				<td>".$row['branch']."</td>
				<td>".$row['city']."</td>
				<td>".$row['address']."</td>
				<td>".$row['country']."</td>
				<td>".$row['country_code']."</td>
				<td><a href=swift-edit.php?id=".$row['id']."><button class='btn btn-primary'>Edit</button></a></td>
		   	  </tr>";
        }
	mysqli_close($dbconn);
    ?>
		
                </tbody>
              </table>
		
		
			<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">

    
	<li <?php if($page <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page > 1){ echo "href='?sea=".$sea."&page=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?sea=".$sea."&page=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?sea=".$sea."&page=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?sea=".$sea."&page=$second_last'>$second_last</a></li>";
		echo "<li><a href='?sea=".$sea."&page=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page > 4 && $page < $total_no_of_pages - 4) {		 
		echo "<li><a href='?sea=".$sea."&page=1'>1</a></li>";
		echo "<li><a href='?sea=".$sea."&page=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {			
           if ($counter == $page) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?sea=".$sea."&page=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?sea=".$sea."&page=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?sea=".$sea."&page=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?sea=".$sea."&page=1'>1</a></li>";
		echo "<li><a href='?sea=".$sea."&page=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?sea=".$sea."&page=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page < $total_no_of_pages) { echo "href='?sea=".$sea."&page=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page < $total_no_of_pages){
		echo "<li><a href='?sea=".$sea."&page=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>	
                     </div>
	</div>
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
                <p>Are you sure want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>