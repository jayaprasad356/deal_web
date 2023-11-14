<?php if($sidebar_status=='Show'): ?>	

<aside class="sidebar sidebar-primary widget-area" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="https://schema.org/WPSideBar">
                <h2 class="screen-reader-text">Primary Sidebar</h2>
				<section class="widget">
					<form class="search-form"  method="get" action="<?php echo BASE_URL; ?>pin-search"><input style="width: 80%;" class="search" type="search" name="term"  placeholder="Search..." value=""><button style="width: 20%;" class="submit" type="submit"><i class="fa fa-search"></i></button>
					</form>
				
				</section>
				
				<?php
//Getting the top advertisement photo and url from database
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=2");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>

                <!-- START ADVERTISEMENT -->
								<?php if($adv_status == 'Show'): ?>
									<section class="widget">
										<div class="smi-ads">	
											<?php echo $adv_url; ?>
										</div>
									</section>
								<?php endif; ?>
                            <!-- END OF /. ADVERTISEMENT -->
                   
		
				<?php if($pin_sidebar_status=='Show'): ?>
	<section class="widget widget_categories">
        <div class="widget-wrap">
            <h3 class="widget-title">1st 2 Digits Postal Circle</h3>
            <ul>
				<li><a href="<?php echo PIN_URL; ?>Delhi">11 - Delhi</a></li>
				<li><a href="<?php echo PIN_URL; ?>haryana">12 - 13 Haryana</a></li>
				<li><a href="<?php echo PIN_URL; ?>punjab">14 - 16 Punjab</a></li>
				<li><a href="<?php echo PIN_URL; ?>himachal-pradesh">17 - Himachal Pradesh</a></li>
				<li><a href="<?php echo PIN_URL; ?>jammu-and-kashmir">18 - 19 Jammu &amp; Kashmir</a></li>
				<li><a href="<?php echo PIN_URL; ?>uttar-pradesh">20 - 28 Uttar Pradesh</a></li>
				<li><a href="<?php echo PIN_URL; ?>rajasthan">30 - 34 Rajasthan</a></li>
				<li><a href="<?php echo PIN_URL; ?>gujarat">36 - 39 Gujarat</a></li>
				<li><a href="<?php echo PIN_URL; ?>maharashtra">40 - 44 Maharashtra</a></li>
				<li><a href="<?php echo PIN_URL; ?>madhya_pradesh">45 - 48 Madhya Pradesh</a></li>
				<li><a href="<?php echo PIN_URL; ?>chhattisgarh">49 - Chhattisgarh</a></li>
				<li><a href="<?php echo PIN_URL; ?>andhra-pradesh">50 - 53 Andhra Pradesh</a></li>
				<li><a href="<?php echo PIN_URL; ?>telangana">50 - 53 TELANGANA</a></li>
				<li><a href="<?php echo PIN_URL; ?>karnataka">56 - 59 Karnataka</a></li>
				<li><a href="<?php echo PIN_URL; ?>tamil-nadu">60 - 64 Tamil Nadu</a></li>
				<li><a href="<?php echo PIN_URL; ?>kerala">67 - 69 Kerala</a></li>
				<li><a href="<?php echo PIN_URL; ?>lakshadweep">682- Lakshadweep</a></li>
				<li><a href="<?php echo PIN_URL; ?>west_bengal">70 - 74 West Bengal</a></li>
				<li><a href="<?php echo PIN_URL; ?>andaman-and-nicobar-islands">744- Andaman &amp; Nicobar</a></li>
				<li><a href="<?php echo PIN_URL; ?>orissa">75 - 77 Orissa</a></li>
				<li><a href="<?php echo PIN_URL; ?>ASSAM">78 - Assam</a></li>
				<li><a href="<?php echo PIN_URL; ?>arunachal-pradesh">79 - Arunachal Pradesh</a></li>
				<li><a href="<?php echo PIN_URL; ?>manipur">79 - Manipur</a></li>
				<li><a href="<?php echo PIN_URL; ?>meghalaya">79 - Meghalaya</a></li>
				<li><a href="<?php echo PIN_URL; ?>mizoram">79 - Mizoram</a></li>
				<li><a href="<?php echo PIN_URL; ?>nagaland">79 - Nagaland</a></li>
				<li><a href="<?php echo PIN_URL; ?>tripura">79 - Tripura</a></li>
				<li><a href="<?php echo PIN_URL; ?>bihar">80 - 85 Bihar</a></li>
				<li><a href="<?php echo PIN_URL; ?>jharkhand">80 - 83, 92 Jharkhand</a></li>
            </ul>
        </div>
    </section>	
<?php endif; ?>

				<?php if($news_sidebar_status=='Show'): ?>	
				
                <section class="widget widget_recent_entries">
                    <div class="widget-wrap">
					<?php
		$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$recent_news_sidebar = $row['recent_news_sidebar'];
			$popular_news_sidebar = $row['popular_news_sidebar'];
		}
		?>
                        <h3 class="widget-title"><?php echo LATEST_NEWS; ?></h3>
                        <ul>
                           <?php
			$i=0;
			$statement = $pdo->prepare("SELECT * FROM tbl_news ORDER BY news_id DESC");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result as $row) {
				$i++;
				if($i>$recent_news_sidebar) {break;}
				?>
				<li><a href="<?php echo BASE_URL.URL_NEWS.$row['news_slug']; ?>"><?php echo $row['news_title']; ?></a></li>
				<?php
			}
			?>
                        </ul>
                    </div>
                </section>
				<?php endif; ?>
				<?php if($sidebar_widget_status=='Show'): ?>	
                <section class="widget widget_modified">
                    <div class="widget-wrap">
                        <h3 class="widget-title"><?php echo $sidebar_widget_title; ?></h3>
                        <?php echo $sidebar_widget_code; ?>
                    </div>
                </section>
				<?php endif; ?>				
</aside>
<?php endif; ?>