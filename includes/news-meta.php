<?php require_once('home_rewrite.php'); ?>

<?php

include 'minifier.php';

ob_start('minify_html');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Showing the SEO related meta tags data -->
	<?php
	
	// Getting the current page URL
	$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

	if($cur_page == 'news.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
		    $og_photo = $row['photo'];
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}
	if($cur_page == 'blogs.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
		    $og_photo = $row['photo'];
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}

	if($cur_page == 'page.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}

	if($cur_page == 'category.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row)
		{
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}
	
if($cur_page == 'branch.php')
	{
		// Getting the news detailed data from the news id
$statement = $pdo->prepare("SELECT * FROM bank_details WHERE bank_branch=?");
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

		$string = $ifsc_title;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageDescription = str_replace($find, $replace, $string);
        
		$pageKeywords = $bank_ifsc . " IFSC Code, " . $bank_name . " " . $bank_branch . " branch, " . $bank_name . " " . $bank_ifsc . " ," . $bank_name . " " . $bank_district.",";
		
		$string = $ifsc_heading;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $ifsc_keywords;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$ifsc_keywords = str_replace($find, $replace, $string);
		
		echo '<title>'. $pageTitle .'</title>';
		
		echo '<meta name="description" content="'.$pageDescription.'">';
		
		echo '<meta name="keywords" content="'.$pageKeywords .'">';
		
		$og_photo = $ifsc_photo;
	
	}

	if($cur_page == 'ifsccode.php')
	{
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

		$string = $ifsc_title;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageDescription = str_replace($find, $replace, $string);
        
		$pageKeywords = $bank_ifsc . " IFSC Code, " . $bank_name . " " . $bank_branch . " branch, " . $bank_name . " " . $bank_ifsc . " ," . $bank_name . " " . $bank_district.",";
		
		$string = $ifsc_heading;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $ifsc_keywords;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$ifsc_keywords = str_replace($find, $replace, $string);
		
		echo '<title>'. $pageTitle .'</title>';
		
		echo '<meta name="description" content="'.$pageDescription.'">';
		
		echo '<meta name="keywords" content="'.$pageKeywords .'">';
		
		$og_photo = $ifsc_photo;
	
	}
	
	
   
	  if($cur_page == 'micrcode.php')
	{
		// Getting the news detailed data from the news id
$statement = $pdo->prepare("SELECT * FROM bank_details WHERE bank_micr=?");
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

		$string = $micr_title;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[micrcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_micr");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $micr_description;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[micrcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_micr");
		$pageDescription = str_replace($find, $replace, $string);
        
		$pageKeywords = $bank_ifsc . " IFSC Code, " . $bank_name . " " . $bank_branch . " branch, " . $bank_name . " " . $bank_ifsc . " ," . $bank_name . " " . $bank_district.",";
		
		$string = $micr_heading;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[micrcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_micr");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $micr_paragraph;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[micrcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_micr");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $micr_keywords;
		$find = array('[bank]', '[state]', '[district]', '[branch]','[micrcode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_micr");
		$micr_keywords = str_replace($find, $replace, $string);
		
		echo '<title>'. $pageTitle .'</title>';
		
		echo '<meta name="description" content="'.$pageDescription.'">';
		
		echo '<meta name="keywords" content="'.$pageKeywords .'">';
		
		$og_photo = $micr_photo;
	
	}
	
	if($cur_page == 'swiftcode.php')
	{
// Getting the Swift code detailed data from the Sift code id
$statement = $pdo->prepare("SELECT * FROM swift_details WHERE swift_code=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$bank = ucwords(strtolower($row['bank']));
	$country = ucwords(strtolower($row['country']));
	$country_code = ucwords(strtolower($row['country_code']));
	$branch = ucwords(strtolower($row['branch']));
	$city = ucwords(strtolower($row['city']));
	$swift_code = $row['swift_code'];

}
		$string = $swift_title;
		$find = array('[bank]', '[city]', '[swiftcode]', '[branch]', '[country]','[countryshort]');
		$replace = array("$bank", "$city", "$swift_code", "$branch", "$country", "$country_code");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $swift_description;
		$find = array('[bank]', '[city]', '[swiftcode]', '[branch]', '[country]','[countryshort]');
		$replace = array("$bank", "$city", "$swift_code", "$branch", "$country", "$country_code");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $swift_code." Swift Code, ".$city." ".$swift_code." swiftcode, ".$swift_code." ".$city." Post office, ".$swift_code." ".$bank." swift code post offices,";
		
		$string = $swift_heading;
		$find = array('[bank]', '[city]', '[swiftcode]', '[branch]', '[country]','[countryshort]');
		$replace = array("$bank", "$city", "$swift_code", "$branch", "$country", "$country_code");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $swift_paragraph;
		$find = array('[bank]', '[city]', '[swiftcode]', '[branch]', '[country]','[countryshort]');
		$replace = array("$bank", "$city", "$swift_code", "$branch", "$country", "$country_code");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $swift_keywords;
		$find = array('[bank]', '[city]', '[swiftcode]', '[branch]', '[country]','[countryshort]');
		$replace = array("$bank", "$city", "$swift_code", "$branch", "$country", "$country_code");
		$swiftkeywords = str_replace($find, $replace, $string);
		
		$og_photo = $swift_photo;
		
		echo '<title>'. $pageTitle .'</title>';
		
		echo '<meta name="description" content="'.$pageDescription.'">';
		
		echo '<meta name="keywords" content="'.$pageKeywords .'">';
        
		
	}
	{
		$searchTermCC = "";
			
   
   if(isset($_GET['term']) && !empty($_GET['term'])) {
       $searchTermCC = htmlentities(substr($_GET['term'], 0, 30));
   }
	}
	if($cur_page == 'search.php')
	{
		echo '<meta name="description" content="Searched on '.$searchTermCC.' for bank ifsc code, micr code, Pin code, swift Code, Branch, post offices address.">';
			echo '<title>Searched '.$searchTermCC.' by Bank IFSC MICR PIN Post office Swift Code</title>';
	}
		if($cur_page == 'ifsc-search.php')
	{
		echo '<meta name="description" content="Searched on '.$searchTermCC.' for bank ifsc code, micr code, address, branch,">';
			echo '<title>Searched on '.$searchTermCC.' by Bank IFSC/MICR Code</title>';
	}
		if($cur_page == 'pin-search.php')
	{
		echo '<meta name="description" content="Searched '.$searchTermCC.' for Post office, address, Pin code, Postal code.">';
			echo '<title>Searched on '.$searchTermCC.' Post Office Pin Code</title>';
	}
		if($cur_page == 'swift-search.php')
	{
		echo '<meta name="description" content="Searched on '.$searchTermCC.' for Swift code, address, BIC code, bank.">';
			echo '<title>Searched on '.$searchTermCC.' Swift/BIC Code</title>';
	}
	
	if($cur_page == '404.php')
	{
		echo '<meta name="description" content="Page not found - '.$siteTitle.'">';
			echo '<title>Page not found - '.$siteTitle.'</title>';
	}
	
	?>
		<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/uploads/<?php echo $favicon; ?>">
	
	<meta property="og:image" content="<?php echo BASE_URL; ?>assets/uploads/<?php echo $og_photo; ?>">
	
	<?php echo (!empty($google) ? "<meta name=\"google-site-verification\" content=\"" . $google . "\" />\n" : ""); ?>
	<?php echo (!empty($bing) ? "<meta name=\"msvalidate.01\" content=\"" . $bing . "\" />\n" : ""); ?>
	<?php echo (!empty($yandex) ? "<meta name=\"yandex-verification\" content=\"" . $yandex . "\" />\n" : ""); ?>
	 <!--Google fonts-->
    <link rel='stylesheet' id='smi-theme-css' href='<?php echo BASE_URL; ?>css/style.css' type='text/css' media='all' />
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
						<h1 style="font-size: 28px; font-width:bold" itemprop="headline"><a href="<?php echo BASE_URL; ?>"><?php echo $siteTitle; ?></a></h1>
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