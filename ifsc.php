<?php
require_once('includes/news-meta.php');



// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: index.php');
	exit;
}

// Getting the news detailed data from the news id
$statement = $pdo->prepare("SELECT * FROM bank_details WHERE bank_ifsc=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$bank_name = ucwords(strtolower($row['bank_name']));
	$bank_state = ucwords(strtolower($row['bank_state']));
	$bank_district = ucwords(strtolower($row['bank_district']));
	$bank_branch = ucwords(strtolower($row['bank_branch']));
	$bank_city = ucwords(strtolower($row['bank_city']));
	$bank_ifsc = $row['bank_ifsc'];
	$bank_micr = $row['bank_micr'];
	$bank_contact = $row['bank_contact'];
	$bank_address = ucwords(strtolower($row['bank_address']));
}
//if post does not exists redirect user.
if($row['bank_ifsc'] == ''){
	header('Location: /');
	exit;
}
?>
        <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content">
				 <div class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
					<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo BASE_URL; ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1">
                    </span> <span aria-label="breadcrumb separator">/</span>  
					<span class="breadcrumb_last" itemprop="name"><?php echo $bank_ifsc; ?></span>
					</div>
                    <article class="page entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="ifsc-h2" itemprop="headline"><?php echo $hTitle; ?></h1>
                        </header>
                        <div class="entry-content" itemprop="text">

                            <?php echo $pDescription; ?>
       <hr>
						
                    <div class="row">
                        <div class="float-left ifsc">
                         <img src="<?php echo BASE_URL; ?>assets/images/bank-logos/<?php echo "" . imgUrl($bank_name); ?>.png" class="product-logo" alt="<?php echo $bank_name; ?> <?php echo $bank_branch; ?> IFSC Code">  
                        </div>
                        <div class="float-right ifsc">
                            <h4>
								<span>IFSC Code:</span>
									<span class="text-amaranth">
									<?php echo $bank_ifsc; ?>
									</span>
							</h4>
                        </div>
                    </div>
						    <?php
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
				<div id="ifscDetails" itemscope itemtype="http://schema.org/LocalBusiness">
					<span itemprop="telephone" class="dontshow"><?php echo $bank_contact; ?></span>
					<span itemprop="name" class="dontshow"><?php echo $bank_name; ?>&nbsp;<?php echo $bank_branch; ?></span>
					<img src="<?php echo BASE_URL; ?>assets/images/bank-logos/<?php echo "" . seoUrl($bank_branch); ?>.png" class="dontshow" alt="<?php echo $bank_name; ?>" itemprop="image"/>
                    <div class="table" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">                       
                        <table class="table table-bordered table-striped">
                                 <tbody>
								 <tr>
										<td colspan="2"><h2 class="ifsc-h2"><?php echo $pageTitle; ?></h2></td>
									</tr>
                                    <tr>
                                       <th>Bank Name</th>
                                       <td class="word-break">
                                          <a href="<?php echo BASE_URL . "" . seoUrl($bank_name); ?>"><?php echo $bank_name; ?></a>
                                       </td>
                                    </tr>
									<tr>
                                       <th>IFSC Code</th>
                                       <td class="little-medium">
									   <strong><?php echo $bank_ifsc; ?>
										</strong>
										<button class="copy-btn" onclick="copy(this)" data-clipboard-text="<?php echo $bank_ifsc; ?>">Copy</button>
										   <input name="ifsc code" type="text" size="11" maxlength="11" value="<?php echo $bank_ifsc; ?>" title="<?php echo $bank_ifsc; ?>" onfocus="this.select()" class="ifscTxt">
										   <br>
											<small>(used for RTGS and NEFT transactions)
											</small>
                                       </td>
                                    </tr>
                                    
                                    <tr>
                                       <th>MICR Code</th>
                                       <td>
									   <?php if (!empty($bank_micr)) { echo $bank_micr; }else{ echo 'Not Available'; }?>
									  
                                       </td>
                                    </tr>
									<tr>
                                       <th>Branch</th>
                                       <td class="little-medium">
                                          <a href="<?php echo BASE_URL . "" . seoUrl($bank_name) . "/" . seoUrl($bank_state) . "/" . seoUrl($bank_district) . "/" . seoUrl($bank_branch); ?>"><?php echo $bank_branch; ?></a>
                                       </td>
                                    </tr>
                                    
                                    <tr>
                                       <th>State</th>
                                       <td itemprop="addressRegion">
                                          <a href="<?php echo BASE_URL . "" . seoUrl($bank_name) . "/" . seoUrl($bank_state); ?>"><?php echo $bank_state; ?></a>
                                    </tr>
                                    <tr>
                                       <th>District</th>
                                       <td itemprop="addressLocality">
                                          <a href="<?php echo BASE_URL . "" . seoUrl($bank_name) . "/" . seoUrl($bank_state) . "/" . seoUrl($bank_district); ?>"><?php echo $bank_district; ?></a>
                                       </td>
                                    </tr>
                                    
                                    <tr>
                                       <th>City</th>
                                       <td class="little-medium">
                                         <?php echo $bank_city; ?>
                                       </td>
                                    </tr>
									<tr>
                                       <th>Address</th>
                                       <td class="word-break">
                                           <span itemprop="streetAddress"><?php echo $bank_address; ?></span>
                                       </td>
                                    </tr>
                                    
                                    <tr>
                                       <th>Contact Phone</th>
                                       <td>
									    <?php if (!empty($bank_contact)) { echo $bank_contact; }else{ echo 'Not Available'; }?>
										
                                       </td>
                                    </tr>
                                    
                                 </tbody>
                        </table>
                             
					</div>
	<!--Share--Start---->
						<?php include "includes/share.php"; ?>	
						<!--Share--End---->
<br>						
<p>Along with your account number, account name and account type (ie., savings or current) the following information about the branch is to be provided for fund transfer:</p>
<ul>
	<li><b> Bank Name</b> : <?php echo $bank_name; ?> </li>
	<li><b> Branch Name</b> : <?php echo $bank_branch; ?></li>
	<li><b> IFSC Code</b> : <?php echo $bank_ifsc; ?></li>
	<li><b> Location</b> : <?php echo $bank_district; ?>, <?php echo $bank_state; ?></li>
</ul>
                        
                    
				</div>								
                            
                        </div>
                    </article>
					<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=5");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>
<?php if($adv_status == 'Show'): ?>
					<div class="after-entry widget-area">
                        <section class="widget_text widget">
                            <?php echo $adv_url; ?>
                        </section>
                    </div>
<?php endif; ?>
<!-- Ad1 End -->
<?php 
$bankcode = substr($bank_ifsc, 0,4);
$branchcode = substr($bank_ifsc, -6);?>
					

	<div class="entry entry-content"> 
		
			<?php
				$statement1 = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_category_id=3");
				$statement1->execute();
				$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
				foreach ($result1 as $row1) {
				$j++;
					?>
<?php 
$string = $row1['faq_title'];
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]', '[bankcode]', '[branchcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc", "$bankcode", "$branchcode");
		$faq_title = str_replace($find, $replace, $string);
		
$string = $row1['faq_content'];
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]', '[bankcode]', '[branchcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc", "$bankcode", "$branchcode");
		$faq_content = str_replace($find, $replace, $string);	
			
					?>
		<div class="panel-group bank-container" id="ifsc-faq">
			<div class="panel panel-default">
				<a data-toggle="collapse" class="collapsible" data-parent="#accordion<?php echo $i; ?>" href="#collapse<?php echo $j; ?>" aria-expanded="false">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo $faq_title; ?><i class="pull-right glyphicon glyphicon-plus"></i><i class="pull-right glyphicon glyphicon-minus"></i></h4>
					</div>
				</a>
				<div class="panel-collapse collapse " id="#collapse<?php echo $j; ?>">
					<div class="panel-body white-box white-box">
					<?php echo $faq_content; ?>
					</div>
				</div>
			</div> 
			
		</div> 
		<?php
			}
			?>
	</div>
					
                </main>
				 <!-- START SIDE CONTENT -->
                    <?php include "includes/sidebar.php"; ?>
                    <!-- END OF /. SIDE CONTENT --> 
             
			 </div>
        </div>
<!-- *** END OF /. PAGE MAIN CONTENT *** -->
<?php require_once('includes/footer.php'); ?>             