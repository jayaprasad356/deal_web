<?php if($sidebar_status=='Show'): ?>	

<aside class="sidebar sidebar-primary widget-area" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="https://schema.org/WPSideBar">
                <h2 class="screen-reader-text">Primary Sidebar</h2>
				<section class="widget">
					<form class="search-form"  method="get" action="<?php echo BASE_URL; ?>swift-search"><input style="width: 80%;" class="search" type="search" name="term"  placeholder="Search..." value=""><button style="width: 20%;" class="submit" type="submit"><i class="fa fa-search"></i></button>
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
				
				<?php if($swift_sidebar_status=='Show'): ?>	
	<section class="widget widget_categories">
        <div class="widget-wrap">
            <h3 class="widget-title">MOST POPULAR COUNTRYS</h3>
            <ul>
                <li><a href="<?php echo SWIFT_URL; ?>France">France</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>United-States">United States</a></li>
                <li><a href="<?php echo SWIFT_URL; ?>Spain">Spain</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>China">China</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Italy">Italy</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>United">United</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Germany">Germany</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Mexico">Mexico</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Thailand">Thailand</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Turkey">Turkey</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Austria">Austria</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Malaysia">Malaysia</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Hong_Kong">Hong Kong</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Greece">Greece</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Russia">Russia</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Japan">Japan</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Canada">Canada</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Saudi-Arabia">Saudi Arabia</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Poland">Poland</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>South-Korea">South Korea</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Netherlands">Netherlands</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Macao">Macao</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Hungary">Hungary</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>United-Arab-Emirates">United Arab Emirates</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>India">India</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Croatia">Croatia</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Ukraine">Ukraine</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Singapore">Singapore</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Indonesia">Indonesia</a></li>
				<li><a href="<?php echo SWIFT_URL; ?>Czech-Republic">Czech Republic</a></li>
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