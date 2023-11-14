<?php if($sidebar_status=='Show'): ?>	

<aside class="sidebar sidebar-primary widget-area" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="https://schema.org/WPSideBar">
                <h2 class="screen-reader-text">Primary Sidebar</h2>
				<section class="widget">
					<form class="search-form"  method="get" action="<?php echo BASE_URL; ?>ifsc-search"><input style="width: 80%;" class="search" type="search" name="term"  placeholder="Search..." value=""><button style="width: 20%;" class="submit" type="submit"><i class="fa fa-search"></i></button>
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
									<section class="widget sidebar">
										<div class="smi-ads">	
											<?php echo $adv_url; ?>
										</div>
									</section>
								<?php endif; ?>
                            <!-- END OF /. ADVERTISEMENT -->

				<?php if($ifsc_sidebar_status=='Show'): ?>	
	<section class="widget widget_categories">
		<div class="widget-wrap">
			<h3 class="widget-title">MOST POPULAR BANKS</h3>
			<ul>
				
				<li><a href="<?php echo BASE_URL; ?>andhra-bank">Andhra Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>axis-bank">Axis Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>bank-of-baroda">Bank Of Baroda</a></li>
				<li><a href="<?php echo BASE_URL; ?>bank-of-india">Bank Of India</a></li>
				<li><a href="<?php echo BASE_URL; ?>bank-of-maharashtra">Bank Of Maharashtra</a></li>
				<li><a href="<?php echo BASE_URL; ?>central-bank-of-india">Central Bank Of India</a></li>
				<li><a href="<?php echo BASE_URL; ?>dena-bank">Dena Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>hdfc-bank">Hdfc Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>icici-bank-limited">ICICI Bank Limited</a></li>
				<li><a href="<?php echo BASE_URL; ?>kotak-mahindra-bank-limited">Kotak Mahindra Bank Limited</a></li>
				<li><a href="<?php echo BASE_URL; ?>punjab-national-bank">Punjab National Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>state-bank-of-india">State Bank Of India</a></li>
				<li><a href="<?php echo BASE_URL; ?>canara-bank">Canara Bank</a></li>
				<li><a href="<?php echo BASE_URL; ?>citi-bank">Citi Bank</a></li>
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