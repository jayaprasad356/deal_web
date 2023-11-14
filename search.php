<?php require 'includes/news-meta.php'; ?>
<?php
   
   if(!empty($searchTermCC)) {
       $currPageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $startoffset = ($currPageNumber-1) * $numberOfRecordsPP;
       
       $searchBankTermCC = isset($_GET['term_bank']) ? filterInput($_GET['term_bank']) : "";
       
       if($searchBankTermCC) {
           $recordsQuery =	"SELECT * FROM `bank_details` WHERE `bank_name` = '".$searchBankTermCC."' AND ( `bank_ifsc` like '%$searchTermCC%' OR `bank_micr` like '%$searchTermCC%' OR `bank_branch` like '%$searchTermCC%' OR `bank_address` like '%$searchTermCC%' OR `bank_contact` like '%$searchTermCC%' OR `bank_city` like '%$searchTermCC%' OR `bank_district` like '%$searchTermCC%' OR `bank_state` like '%$searchTermCC%')";
       } else {
           $recordsQuery = "SELECT * FROM `bank_details` WHERE `bank_name` like '%$searchTermCC%' OR `bank_ifsc` like '%$searchTermCC%' OR `bank_micr` like '%$searchTermCC%' OR `bank_branch` like '%$searchTermCC%' OR `bank_address` like '%$searchTermCC%' OR `bank_contact` like '%$searchTermCC%' OR `bank_city` like '%$searchTermCC%' OR `bank_district` like '%$searchTermCC%' OR `bank_state` like '%$searchTermCC%'";
       }
       
       $totalRecords =	mysqli_num_rows(mysqli_query($dbconn, $recordsQuery));
       $totalPages = ceil($totalRecords / $numberOfRecordsPP);
   }
?>
       <!-- *** START PAGE MAIN CONTENT *** -->
        <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content">
				<div class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
					<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo BASE_URL; ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name">Home </span></a>
                    <span aria-label="breadcrumb separator"> / </span> 
					<span class="breadcrumb_last" itemprop="name"> <?php echo $searchTermCC; ?> </span>
				</div>
			<div class="post entry"
                        itemscope itemtype="https://schema.org/CreativeWork">
						<header class="entry-header">
                            <h1 class="entry-title" itemprop="headline">Searched by: IFSC/MICR <?php echo $searchTermCC; ?></h1>
						</header>
				<div class="entry-content" itemprop="text">
							<p>Lookup for banks, branches, IFSC codes, MICR Code, City State, contact address/phone, etc.</p>
<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=3");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>
<?php if($adv_status == 'Show'): ?>
<div class="ad3">
	<?php echo $adv_url; ?>
</div>
<?php endif; ?>
<!-- Ad1 End -->
<br>									
				<form class="search-form">
                        <?php
                        
                        if($showBankNamesDropdown) {
                        ?>
					<div class="form-default">
						<div class="search-form">
							<select name="term_bank" id="term-bank" class="form-control custom-select shadow pl-3">
                            
                            <?php
                            if($searchBankTermCC) {
                            ?>
                              <option disabled>Select a Bank</option>
								<option value="<?php echo seoUrl($result['bank_name']); ?>" selected><?php echo strtoupper($searchBankTermCC); ?></option>
                                
                                <?php
                            }
                                else {
                                    ?>
                                     <option disabled selected>Select a Bank</option>
                                     <?php
                                }
                            
                            // -- fetch banks query
                            
                            $dbQuery = "SELECT DISTINCT `bank_name` FROM `bank_details` ORDER BY `bank_name` ASC";
                            
                            $dbQueryResult = mysqli_query($dbconn, $dbQuery);
                            $totalResultsCount = intval(mysqli_num_rows($dbQueryResult));
                            
                            if($totalResultsCount > 0) {
                                while($result = mysqli_fetch_array($dbQueryResult, MYSQLI_ASSOC)) {
                                ?>
                                    <option value="<?php echo seoUrl($result['bank_name']); ?>"><?php echo $result['bank_name']; ?></option>
                                <?php
                                }
                            }
                            ?>
                                
							</select>
						</div>
					</div>
                        
                        <?php
                        }
                        ?>
                </form>
				<div class="form-default"><form class="search-form" action="<?php echo BASE_URL; ?>ifsc-search"><input class="search" type="search" name="term"  placeholder="Search..." value="<?php echo $searchTermCC; ?>"><button class="submit" type="submit"><i class="fa fa-search"></i></button></form></div>
				<?php
if(!empty($searchTermCC)) {
?>
 <br>			
			<div class="center">
				<h2>Search Results <?php echo $searchTermCC; ?></h2>
				<p><?php echo ($searchBankTermCC ? "Selected bank: " . $searchBankTermCC . "<br/>" : ""); ?> Total results: <?php echo $totalRecords; ?></p>
			 </div>		    
        <?php
			    
		if($totalRecords > 0) {
			?>
			<table class="table table-bordered custom-table">
                <tbody>
			<?php
		    
		    $searchQuery = mysqli_query($dbconn, $recordsQuery . " LIMIT $startoffset, $numberOfRecordsPP");
			        
			$counter = $startoffset;
			        
			while($record = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC)) {
			    
			    $recordName = $record['bank_name'] . " > " . $record['bank_state'] . " > " . $record['bank_district'] . " > " . $record['bank_branch'] . " > " . $record['bank_ifsc'];
			         
			    $recordUrl = BASE_URL. "" . seoUrl($record['bank_name']) . "/" . seoUrl($record['bank_state']) . "/" . seoUrl($record['bank_district']) . "/" . seoUrl($record['bank_branch']);
                    
        ?>
                    <tr>
                        <td><?php echo ++$counter . ". "; ?>
							<a href="<?php echo $recordUrl; ?>"><?php echo $recordName; ?></a>
						</td>
                    </tr>
                           
        <?php
		    }
		    
		   ?>
							</tbody>
                        </table>	
						</div>
					</div>				
			<div style="background: #fff; padding: 15;">
				<div class="archive-pagination pagination">
					<ul>
						<span style="float: left;"><span>Page: <?php echo $currPageNumber . "/" . $totalPages; ?>&nbsp;</span></span>
			
			
		<?php
		
		if($totalPages > 1) {
		    if($currPageNumber != 1) {
		?>
			   <li class="pagination-previous"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber - 1); ?>">« Prev</a></li>
		<?php
			}
			if($currPageNumber < $totalPages) {
		?>
			   <li class="pagination-next"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber + 1); ?>">Next »</a></li> 
	<?php
			}
		}
		echo'</ul>';      
		} else {
		?>
				
						<p class="not-found">
							Sorry! No found by your search term.
						</p>
					
			 
		<?php
		}
		?>
		
		<?php	
		}
			
		?>
                
					</div>
				</div>
             <?php 
   if(!empty($searchTermCC)) {
       $currPageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $startoffset = ($currPageNumber-1) * $numberOfRecordsPP;
       
       $searchBankTermCC = isset($_GET['term_state']) ? filterInput($_GET['term_state']) : "";
       
       if($searchBankTermCC) {
           $recordsQuery =	"SELECT * FROM `pin_details` WHERE `pin_state` = '".$searchBankTermCC."' AND ( `pin_code` like '%$searchTermCC%' OR `state_short` like '%$searchTermCC%' OR `pin_office` like '%$searchTermCC%' OR `pin_region` like '%$searchTermCC%' OR `pin_contact` like '%$searchTermCC%' OR `pin_taluk` like '%$searchTermCC%' OR `pin_district` like '%$searchTermCC%' OR `pin_division` like '%$searchTermCC%')";
       } else {
           $recordsQuery = "SELECT * FROM `pin_details` WHERE `pin_state` like '%$searchTermCC%' OR `pin_code` like '%$searchTermCC%' OR `state_short` like '%$searchTermCC%' OR `pin_office` like '%$searchTermCC%' OR `pin_region` like '%$searchTermCC%' OR `pin_contact` like '%$searchTermCC%' OR `pin_taluk` like '%$searchTermCC%' OR `pin_district` like '%$searchTermCC%' OR `pin_division` like '%$searchTermCC%'";
       }
       
       $totalRecords =	mysqli_num_rows(mysqli_query($dbconn, $recordsQuery));
       $totalPages = ceil($totalRecords / $numberOfRecordsPP);
   }
?>
       <!-- *** START PAGE MAIN CONTENT *** -->

					<div class=" post entry"
                        itemscope itemtype="https://schema.org/CreativeWork">
						<header class="entry-header">
                            <h1 class="entry-title" itemprop="headline">Searched by: PIN Postal Code <?php echo $searchTermCC; ?></h1>
						</header>
						<div class="entry-content" itemprop="text">
                       
						<p>Lookup for Post Offices, PIN codes, Postal Code, State, District,  contact address/phone, etc.</p>
<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=3");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>
<?php if($adv_status == 'Show'): ?>

	<?php echo $adv_url; ?>

<?php endif; ?>
<!-- Ad1 End -->								
					<form class="search-form"> 
                        <?php
                        
                        if($showBankNamesDropdown) {
                        ?>
						<div class="form-default">
							<div class="search-form">
								<select name="term_state" id="term-bank" class="form-control custom-select shadow">
                            
                            <?php
                            if($searchBankTermCC) {
                            ?>
								<option disabled>Select a State</option>
								<option value="<?php echo seoUrl($result['pin_state']); ?>" selected><?php echo strtoupper($searchBankTermCC); ?></option>
                                
                                <?php
                            }
                                else {
                                    ?>
                                     <option disabled selected>Select a State</option>
                                     <?php
                                }
                            
                            // -- fetch banks query
                            
                            $dbQuery = "SELECT DISTINCT `pin_state` FROM `pin_details` ORDER BY `pin_state` ASC";
                            
                            $dbQueryResult = mysqli_query($dbconn, $dbQuery);
                            $totalResultsCount = intval(mysqli_num_rows($dbQueryResult));
                            
                            if($totalResultsCount > 0) {
                                while($result = mysqli_fetch_array($dbQueryResult, MYSQLI_ASSOC)) {
                                ?>
                                    <option value="<?php echo seoUrl($result['pin_state']); ?>"><?php echo $result['pin_state']; ?></option>
                                <?php
                                }
                            }
                            ?>
                                
								</select>
							</div>
						</div>
                        
                        <?php
                        }
                        ?>

                </form>
				<div class="form-default"><form class="search-form" action="<?php echo BASE_URL; ?>pin-search"><input class="search" type="search" name="term"  placeholder="Search..." value="<?php echo $searchTermCC; ?>"><button class="submit" type="submit"><i class="fa fa-search"></i></button></form></div>
					
					
				<?php
if(!empty($searchTermCC)) {
?>
<br>
			<div class="center">
				<h3>Search Results <?php echo $searchTermCC; ?></h3>
				<p><?php echo ($searchBankTermCC ? "Selected State: " . $searchBankTermCC . "<br/>" : ""); ?> Total results: <?php echo $totalRecords; ?></p>
			</div>		    
        <?php
			    
		if($totalRecords > 0) {
			?>
			<table class="table table-bordered custom-table">
                            <tbody>
			<?php
		    
		    $searchQuery = mysqli_query($dbconn, $recordsQuery . " LIMIT $startoffset, $numberOfRecordsPP");
			        
			$counter = $startoffset;
			        
			while($record = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC)) {
			    
			    $recordName = $record['pin_state'] . " > " . $record['pin_district'] . " > " . $record['pin_office'] . " > " . $record['pin_code'];
			         
			    $recordUrl = PIN_URL. "" . seoUrl($record['pin_state']) . "/" . seoUrl($record['pin_district']) . "/" . seoUrl($record['pin_type']) . "/" . seoUrl($record['pin_office']);
                    
        ?>
                    <tr>
                        <td><?php echo ++$counter . ". "; ?>
							<a href="<?php echo $recordUrl; ?>"><?php echo $recordName; ?></a>
						</td>
                    </tr>
                           
        <?php
		    }
		    
		   ?>
							</tbody>
                        </table>	
		</div>
					</div>				
			<div style="background: #fff; padding: 15;">
				<div class="archive-pagination pagination">
					<ul>
						<span style="float: left;"><span>Page: <?php echo $currPageNumber . "/" . $totalPages; ?>&nbsp;</span></span>		
		<?php
		
		if($totalPages > 1) {
		    if($currPageNumber != 1) {
		?>
			   <li class="pagination-previous"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber - 1); ?>">« Prev</a></li>
		<?php
			}
			if($currPageNumber < $totalPages) {
		?>
			   <li class="pagination-next"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber + 1); ?>">Next »</a></li> 
		<?php
			}
		}
		 echo'</ul>';   
		} else {
		?>
				
						<p class="not-found">
							Sorry! No found by your search term.
						</p>
				
				
			 
		<?php
		}
		?>
		
		
		
		
		<?php	
		}
			
		?>
					</div>
				</div>

<?php
   
   if(!empty($searchTermCC)) {
       $currPageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $startoffset = ($currPageNumber-1) * $numberOfRecordsPP;
       
       $searchBankTermCC = isset($_GET['term_country']) ? filterInput($_GET['term_country']) : "";
       
       if($searchBankTermCC) {
           $recordsQuery =	"SELECT * FROM `swift_details` WHERE `country` = '".$searchBankTermCC."' AND ( `swift_code` like '%$searchTermCC%' OR `bank` like '%$searchTermCC%' OR `branch` like '%$searchTermCC%' OR `address` like '%$searchTermCC%' OR `city` like '%$searchTermCC%' OR `country` like '%$searchTermCC%')";
       } else {
           $recordsQuery = "SELECT * FROM `swift_details` WHERE `country` like '%$searchTermCC%' OR `swift_code` like '%$searchTermCC%' OR `branch` like '%$searchTermCC%' OR `address` like '%$searchTermCC%' OR `city` like '%$searchTermCC%' OR `bank` like '%$searchTermCC%'";
       }
       
       $totalRecords =	mysqli_num_rows(mysqli_query($dbconn, $recordsQuery));
       $totalPages = ceil($totalRecords / $numberOfRecordsPP);
   }
?>
<!-- *** START PAGE MAIN CONTENT *** -->

			<div class="post entry"
                        itemscope itemtype="https://schema.org/CreativeWork">
						<header class="entry-header">
                            <h1 class="entry-title" itemprop="headline">Searched by: Swift/BIC Code <?php echo $searchTermCC; ?></h1>
						</header>
				<div class="entry-content" itemprop="text">
							<p>Lookup for banks, branches, SWIFT codes, Country, City, contact address/phone, BIC code, etc.</p>
<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=3");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>
<?php if($adv_status == 'Show'): ?>
<div class="ad3">
	<?php echo $adv_url; ?>
</div>
<?php endif; ?>
<!-- Ad1 End -->
<br>									
					<form class="search-form">
						
                        <?php  if($showBankNamesDropdown) { ?>
						
							<div class="form-default">
								<div class="search-form">
									<select name="term_country" id="term-bank" class="form-control custom-select shadow">
										<?php if($searchBankTermCC) { ?>
										<option disabled>Select a Country</option>
										<option value="<?php echo seoUrl($result['country']); ?>" selected><?php echo strtoupper($searchBankTermCC); ?></option>
                         <?php }  else {  ?>
										<option disabled selected>Select a Country</option>
                        <?php } // -- fetch banks query
                            
							$dbQuery = "SELECT DISTINCT `country` FROM `swift_details` ORDER BY `country` ASC";
                            
                            $dbQueryResult = mysqli_query($dbconn, $dbQuery);
                            $totalResultsCount = intval(mysqli_num_rows($dbQueryResult));
                            
                            if($totalResultsCount > 0) {
                                while($result = mysqli_fetch_array($dbQueryResult, MYSQLI_ASSOC)) {
                                ?>
										<option value="<?php echo seoUrl($result['country']); ?>"><?php echo $result['country']; ?></option>
                                <?php
                                }
                            }
                            ?>
                                
									</select>
								</div>
							</div>
                        <?php } ?>
						
					</form>
					<div class="form-default"><form class="search-form" action="<?php echo BASE_URL; ?>swift-search"><input class="search" type="search" name="term"  placeholder="Search..." value="<?php echo $searchTermCC; ?>"><button class="submit" type="submit"><i class="fa fa-search"></i></button></form></div>
<?php if(!empty($searchTermCC)) { ?>
<br>			
			<div class="center">
				<h2>Search Results <?php echo $searchTermCC; ?></h2>
					<p><?php echo ($searchBankTermCC ? "Selected bank: " . $searchBankTermCC . "<br/>" : ""); ?> Total results: <?php echo $totalRecords; ?></p>
		    </div>
<?php if($totalRecords > 0) {
			?>
			<table class="table table-bordered custom-table">
                <tbody>
			<?php
		    
		    $searchQuery = mysqli_query($dbconn, $recordsQuery . " LIMIT $startoffset, $numberOfRecordsPP");
			        
			$counter = $startoffset;
			        
			while($record = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC)) {
			    
			    $recordName = $record['country'] . " > " . $record['bank'] . " > " . $record['city'] . " > " . $record['branch'] . " > " . $record['swift_code'];
			         
			    $recordUrl = SWIFT_URL. "" . seoUrl($record['country']) . "/" . seoUrl($record['bank']) . "/" . seoUrl($record['city']) . "/" . seoUrl($record['branch']);
                    
        ?>
                    <tr>
                        <td><?php echo ++$counter . ". "; ?>
							<a href="<?php echo $recordUrl; ?>"><?php echo $recordName; ?></a>
						</td>
                    </tr>
                           
        <?php
		    }
		    
		   ?>
				</tbody>
            </table>	
				</div>
					</div>				
			<div style="background: #fff; padding: 15;">
				<div class="archive-pagination pagination">
					<ul>
						<span style="float: left;"><span>Page: <?php echo $currPageNumber . "/" . $totalPages; ?>&nbsp;</span></span>	
			
		<?php
		
		if($totalPages > 1) {
		    if($currPageNumber != 1) {
		?>
			   <li class="pagination-previous"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber - 1); ?>">« Prev</a></li>
		<?php
			}
			if($currPageNumber < $totalPages) {
		?>
			   <li class="pagination-next"><a href="?term=<?php echo $searchTermCC; ?>&term_bank=<?php echo seoUrl($searchBankTermCC); ?>&page=<?php echo ($currPageNumber + 1); ?>">Next »</a></span> 
		<?php
			}
		}
		echo'</ul>';      
		} else {
		?>
				
						<p class="not-found">
							Sorry! No found by your search term.
						</p>
					
			 
		<?php
		}
		?>
		

		
		
		<?php	
		}
			
		?>
                
					</div>
				</div>				
            </main>
            <!--sidebar--Start---->
						<?php include "includes/sidebar.php"; ?>	
				<!--sidebar--End---->
        </div>
    </div>
				<!--footer--Start---->
				<?php require_once('includes/footer.php'); ?>
						
				<!--footer--End---->
   