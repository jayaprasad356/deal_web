<?php include 'minifier.php';
ob_start('minify_html');
ob_start();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $pageTitle; ?></title>
	<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/uploads/<?php echo $favicon; ?>">
	<!-- description -->
	<meta name="description" content="<?php echo $pageDescription; ?>" />
    <meta name="keywords" content="<?php echo $pageKeywords; ?>" />
    <meta name="language" content="English" />
    <meta name="author" content="<?php echo $author_name; ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:locale" content="en_US" />
    <meta name="robots" content="index, follow" />
	<link rel="canonical" href="<?php echo currentUrl(); ?>" />
    <?php echo (!empty($google) ? "<meta name=\"google-site-verification\" content=\"" . $google . "\" />\n" : ""); ?>
	<?php echo (!empty($bing) ? "<meta name=\"msvalidate.01\" content=\"" . $bing . "\" />\n" : ""); ?>
	<?php echo (!empty($yandex) ? "<meta name=\"yandex-verification\" content=\"" . $yandex . "\" />\n" : ""); ?>
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo $siteTitle; ?>" />
    <meta property="og:url" content="<?php echo currentUrl(); ?>">
    <meta property="og:title" content="<?php echo $pageTitle; ?>">
    <meta property="og:description" content="<?php echo $pageDescription; ?>">
    <meta property="og:image" content="<?php echo BASE_URL; ?>assets/uploads/<?php echo $og_photo; ?>">
    <meta property="og:image:alt" content="<?php echo $siteTitle; ?>" />
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo currentUrl(); ?>">
    <meta property="twitter:title" content="<?php echo $pageTitle; ?>">
    <meta property="twitter:description" content="<?php echo $pageDescription; ?>">
    <meta property="twitter:image" content="<?php echo BASE_URL; ?>assets/uploads/<?php echo $og_photo; ?>">

 <!--Google fonts-->
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>css/style.css' type='text/css' media='all' />
	<?php require_once('style.php'); ?>

		<?php echo $header_code; ?>
    
    <?php
    if($requestedPage === "index") {
    ?>
    <script>
    function formSubmit(selector) {
        formSelectUrl = selector.value;
        window.location.href = formSelectUrl;
    }
    </script>
    <?php
    }
    ?>
  </head>

<body class="<?php echo $theme_width; ?>" itemscope itemtype="https://schema.org/WebPage">

<div class="site-container">
		<?php if($header_style=='header-style-1'): ?>
		<div class="<?php echo $header_style; ?>">
			<header class="new-header m-hide">
				<div class="new-wrap">
					<div class="new-title-area">
					<?php if($logo_status=='Show'): ?>	
						<a href="<?php echo BASE_URL; ?>">
						<img src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $logo; ?>" alt="<?php echo $siteTitle; ?>" title="<?php echo $siteTitle; ?>"></a>
						<?php endif; ?>
						<?php if($logo_status=='Hide'): ?>
						<h1 style="font-size: 28px; font-width:bold" itemprop="headline"><a class="" href="<?php echo BASE_URL; ?>"><?php echo $siteTitle; ?></a></h1>
						<?php endif; ?>
					</div>
					
					<div class="widget-area header-widget-area">
						<div class="widget-wrap">
							<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=1");
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
							
						</div>
					</div>
				</div>
			</header>
		</div>
		<?php endif; ?>

        <header class="site-header <?php echo $header_style; ?>" itemscope itemtype="https://schema.org/WPHeader">
            <div class="wrap">
                
				<?php if($logo_status=='Show'): ?>
				<div class="title-area title-hide">	
                    <p class="site-title"><a href="<?php echo BASE_URL; ?>"><?php echo $siteTitle; ?></a></p>
					</div>
					<?php endif; ?>
					<?php if($logo_status=='Hide'): ?>	
					<div class="title-area title-hide">	
					
                    <a style="color:#fff; padding: 20px 0px; font-size: 25px; line-height:2.2em;" href="<?php echo BASE_URL; ?>"><?php echo $siteTitle; ?></a>
					</div>
					<?php endif; ?>
					
                
                <nav class="nav-primary" aria-label="Main" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <div class="wrap"><input type="checkbox" id="menu-toggle" />
                        <div class="nav-menu"><label for="menu-toggle" class="menu-toggle" onclick><span><?php echo $siteTitle; ?></span></label>
                            <ul id="menu-main-menu" class="menu genesis-nav-menu menu-primary">
							<?php
                                $q = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=? ORDER BY menu_order ASC");
                                $q->execute(array(0));
                                $res = $q->fetchAll();
                                foreach ($res as $row) {
                                    
                                    $r = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=?");
                                    $r->execute(array($row['menu_id']));
                                    $total = $r->rowCount();
									
										 echo '<li class="menu-item '; if($total) {echo 'menu-item-has-children';}; echo'">';
                                    
                                    if($row['page_id'] == 0) {
                                        
                                        if($row['menu_url'] == '') {
                                            $final_url = 'javascript:void(0);';
                                        } else {
                                            $final_url = $row['menu_url'];
                                        }                                       
                                        ?>
                                        <a href="<?php echo $final_url; ?>" itemprop="url"><span itemprop="name"><?php echo $row['menu_name']; ?><?php if($total) {echo '<em></em>';}; ?></span></a>
                                        <?php
                                    } else {
                                        $r = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=? ");
                                        $r->execute(array($row['page_id']));
                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            ?>
                                            <a href="<?php echo BASE_URL.URL_PAGE.$row1['page_slug']; ?>" itemprop="url"><span itemprop="name"><?php echo $row1['page_name']; ?></span></a>
                                            <?php
                                        }
                                    }

                                    // Checking for sub-menu
                                    $r = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=?");
                                    $r->execute(array($row['menu_id']));
                                    $total = $r->rowCount();
                                    if($total) {
                                        echo '<ul class="sub-menu">';

                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            //
                                            echo '<li class="menu-item">';
                                            if($row1['page_id'] == 0) {
                                                if($row1['menu_url'] == '') {
                                                    $final_url1 = 'javascript:void(0);';
                                                } else {
                                                    $final_url1 = $row1['menu_url'];
                                                }
                                                ?>
                                                <a href="<?php echo $final_url1; ?>" itemprop="url"><span itemprop="name"><?php echo $row1['menu_name']; ?></span></a>
                                                <?php
                                            } else {
                                                $s = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
                                                $s->execute(array($row1['page_id']));
                                                $res2 = $s->fetchAll();
                                                foreach ($res2 as $row2) {
                                                    ?>
                                                    <a href="<?php echo BASE_URL.URL_PAGE.$row2['page_slug']; ?> " itemprop="url"><span itemprop="name"><?php echo $row2['page_name']; ?></span></a>
                                                    <?php
                                                }
                                            }
                                            echo '</li>';
                                            //
                                        }

                                        echo '</ul>';
                                    }


                                    echo '</li>';

                                }
                                ?>
							</ul>
							<label for="menu-toggle" class="backdrop"></label>
						</div>
                        <div class="nav-search right"><input type="checkbox" id="search-toggle">
                            <div class="smi-search"><label for="search-toggle" class="search-toggle"><span class="search-icon"><i class="fa fa-search"></i></span></label>
                                <div class="menu-icon">
                                    <form class="search-form" method="get" action="<?php echo BASE_URL; ?>search" role="search" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction"><label class="search-form-label screen-reader-text" for="searchform-1">Search this website</label><input class="search-form-input" type="search" name="term" id="searchform-1" placeholder="Search this website" itemprop="query-input">
                                        <input
                                            class="search-form-submit" type="submit" value="Search">
                                            <meta content="<?php echo BASE_URL; ?>search" itemprop="target">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        
        
        
        
        
        
       <div style="overflow:hidden">
<svg class="svghook1" xmlns="http://www.w3.org/2000/svg" viewBox="0 250 2000 170" preserveAspectRatio="none">
<path d="M1919.16,381.161c-47.52.211-52.83,3.175-52.83,3.175s-8.27,1.9-8.27-4.446c-0.11-7.091,1.06-13.759-3.18-13.97s0.42,12.912-7.64,12.7c-14.75,0-.85-78.532-10.18-78.744s12.94,86.365-23.55,86.365c-12.63,0,1.27-20.321-8.92-20.321s1.17,19.792-7,22.861c-8.48,2.752-56.65,5.715-87.2-6.35s-41.37-18.2-75.1-16.511-27.16,9.525-44.56,8.89c-10.61-.423-0.21-31.752-7-31.752-5.73,0,2.54,23.5-12.09,23.5-25.25,0-2.55-71.124-15.92-71.124-8.7,0,9.18,77.474-19.73,77.474-32.88,0-10.39-55.248-21-55.248s13.03,43.817-25.01,43.817c-23.13,0-10.18-14.6-17.19-14.6s5.63,14.6-10.82,14.6c-18.03,0,.64-53.343-8.91-53.343s7.14,51.438-24.64,51.438c-21.74,0-2.12-64.773-12.09-64.773s5.41,72.394-12.09,72.394c-26.26,0-8.07-17.781-17.83-17.781s13.01,23.5-31,23.5c-18.25,0,2.12-74.3-10.18-74.3s15.48,90.175-29.92,90.175c-42.59,0-89.18-8.909-105.32-18.577-15.48-9.567,7.21-86.2-7.64-86.2s4.88,77.792-17.82,78.109c-16.55-.1-2.55-25.4-12.1-25.4s10.82,24.978-14,27.942c-12.94,1.481-12.09-12.7-51.56-12.7s-47.52,22.12-73.19,26.036c-28.12,3.916-61.214,2.011-73.838,0-14.321-3.175.849-24.131-8.911-24.131s6.153,20.956-8.911,20.956c-35.114,0-10.184-85.73-22.914-85.73s5.2,78.745-7.638,78.745c-13.9,0-1.91-12.066-9.548-12.066s4.486,17.781-5.092,17.781c-10.214,0-7-4.445-18.458-4.445s-6.789,11.431-17.186,11.431-3.606-3.811-22.914-3.811S823.207,394.5,795.625,394.5s-25.46-14.606-54.1-14.606-23.974,8.891-66.832,8.891c-45.4,0-17.61-90.175-29.916-90.175s8.063,74.3-10.184,74.3c-31.347,0-11.244-23.5-21-23.5s8.434,17.781-17.822,17.781c-17.5,0-2.122-72.394-12.094-72.394s9.654,64.773-12.093,64.773c-21.111,0-5.092-51.438-14.64-51.438s6.79,53.343-8.911,53.343c-16.442,0-3.819-14.6-10.82-14.6s5.941,14.6-17.186,14.6c-48.374,0-24.4-43.817-35.007-43.817s11.881,55.248-21,55.248c-28.907,0-11.032-77.474-19.731-77.474-13.367,0,9.335,71.124-15.913,71.124-14.639,0-6.365-23.5-12.093-23.5-6.789,0,3.607,31.329-7,31.752-17.4.635-10.82-7.2-44.555-8.89s-44.555,4.445-75.107,16.511-78.713,9.1-87.2,6.35c-8.168-3.069,3.182-22.861-7-22.861s3.713,20.321-8.911,20.321c-36.492,0-14.215-86.577-23.55-86.365s4.562,78.744-10.184,78.744c-8.062.212-3.395-12.912-7.638-12.7s-3.077,6.879-3.183,13.97c0,6.351-8.274,4.446-8.274,4.446s-5.3-2.964-52.829-3.175S17.5,386.082,0,391.321V458H2000V391.321C1982.5,386.082,1966.69,380.949,1919.16,381.161Z"></path>
</svg>
</div> 
        
        
        
        
        
        
<?php if($header_style == 'header-style-2'): ?>
							<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$adv_url = $row['adv_url'];
	$adv_status = $row['adv_status'];
}
?>
<?php if($adv_status == 'Show'): ?>

	
		<div class="header-banner widget-area">
            <section class="widget smi-ads">
               
				<?php echo $adv_url; ?>
               
            </section>
        </div>
<?php endif; ?>	
<?php endif; ?>	