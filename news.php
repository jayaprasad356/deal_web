
<?php require_once('includes/news-meta.php'); ?>
		
<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: '.BASE_URL);
	exit;
}
else
{
	// Check the category slug is valid or not.
	$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
	$statement->execute(array($_REQUEST['slug']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}

// Getting the news detailed data from the news id
$statement = $pdo->prepare("SELECT
							t1.news_title,
							t1.news_slug,
							t1.news_content,
							t1.news_date,
							t1.publisher,
							t1.photo,
							t1.category_id,
							
							t2.category_id,
							t2.category_name,
							t2.category_slug

                           	FROM tbl_news t1
                           	JOIN tbl_category t2
                           	ON t1.category_id = t2.category_id
                           	WHERE t1.news_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$news_title    = $row['news_title'];
	$news_slug    = $row['news_slug'];
	$news_content  = $row['news_content'];
	$news_date     = $row['news_date'];
	$publisher     = $row['publisher'];
	$photo         = $row['photo'];
	$category_id   = $row['category_id'];
	$category_slug = $row['category_slug'];
	$category_name = $row['category_name'];
}

// Update data for view count for this news page
// Getting current view count
$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$current_total_view = $row['total_view'];
}
$updated_total_view = $current_total_view+1;

// Updating database for view count
$statement = $pdo->prepare("UPDATE tbl_news SET total_view=? WHERE news_slug=?");
$statement->execute(array($updated_total_view,$_REQUEST['slug']));
?>
        <div class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content">
                    <div class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"><span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo BASE_URL; ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name">Home</span></a>
                        <meta
                            itemprop="position" content="1">
                            </span> <span aria-label="breadcrumb separator">/</span> <a href="<?php echo BASE_URL; ?>news">News</a> <span aria-label="breadcrumb separator">/</span> <span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/ListItem"><a class="breadcrumb-link" href="<?php echo BASE_URL.URL_CATEGORY.$category_slug; ?>" itemprop="item"><span class="breadcrumb-link-text-wrap" itemprop="name"><?php echo $category_name; ?></span></a>
                            <meta itemprop="position"
                                content="2">
                            </span> <span aria-label="breadcrumb separator">/</span> <span class="breadcrumb_last" itemprop="name"><?php echo $news_title; ?></span>
					</div>
                    <article class=" post entry"
                        itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo $news_title; ?></h1>
                            <p class="entry-meta">
							<span class="entry-author" itemprop="author" itemscope itemtype="https://schema.org/Person">By: <span class="entry-author-name" itemprop="name"><?php echo $publisher; ?></span>
                            </span>
							<time class="entry-modified-time" itemprop="dateModified" datetime="<?php echo $news_date; ?>">Last Updated: <?php echo DATE; ?> <?php echo $news_date; ?></time></p>
                        </header>
                        <div class="entry-content" itemprop="text">
						
						<?php
// Getting the advertisement that will be shown right below the featured news section
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement WHERE adv_id=4");
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
                            <img class="aligncenter" title="<?php echo $news_title; ?>" src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $photo ?>" alt="<?php echo $news_title; ?>"
                                    width="700" height="396" />
                            
                           
                            <?php echo $news_content; ?>
                            <!-- AI CONTENT END 1 -->
                        </div>
                        <footer class="entry-footer">
                            <div class="socialshare">
                                <div class="social-share inline"><span class="sharetitle">Share</span>
                                    <ul class="share-list">
                                        <li class="icon facebook"><a rel="external nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i><span>Share on Facebook</span></a></li>
                                        <li
                                            class="icon twitter"><a rel="external nofollow" href="https://twitter.com/intent/tweet?<?php echo $news_title; ?>&amp;url=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>&amp"
                                                target="_blank" title="Tweet on Twitter"><i class="fa fa-twitter"></i><span>Tweet on Twitter</span></a></li>
                                            <li class="icon linkedin"><a rel="external nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>&amp;title=<?php echo $news_title; ?>"
                                                    target="_blank" title="Share on Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            <li class="icon email"><a rel="external nofollow" href="mailto:?Subject=<?php echo $news_title; ?>&body=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>" title="Share via Mail"><i class="fa fa-mail"></i></a></li>
                                            <li
                                                class="icon whatsapp"><a rel="external nofollow" href="https://api.whatsapp.com/send?text=<?php echo $news_title; ?> <?php echo BASE_URL.URL_NEWS.$news_slug; ?>"
                                                    target="_blank" title="Share on WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                                <div class="social-share flt hide">
                                    <div class="flt-bar"><input type="checkbox" id="share-toggle">
                                        <div class="flt-bar-button">
                                            <ul class="float-list">
                                                <li class="icon facebook"><a rel="external nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i></li><li class="icon twitter"><a rel="external nofollow" href="https://twitter.com/intent/tweet?text=<?php echo $news_title; ?>&amp;url=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>&amp" target="_blank" title="Tweet on Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li
                                                    class="icon email"><a rel="external nofollow" href="mailto:?Subject=<?php echo $news_title; ?>&body=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>" title="Share via Mail"><i class="fa fa-mail"></i></a></li>
                                                    <li
                                                        class="icon linkedin"><a rel="external nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL.URL_NEWS.$news_slug; ?>&amp;title=<?php echo $news_title; ?>"
                                                            target="_blank" title="Share on Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul><label for="share-toggle" class="share-toggle"><span></span></label></div>
                                    </div>
                                </div>
                            </div>
                        </footer>
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
					
                   
                    
                    <h2 class="screen-reader-text">Reader Interactions</h2>
					<!-- Comment-Start -->
                    <div class="entry-comments">
                        <div class="comment-number">
                            <h3 class="title"><?php echo COMMENTS; ?></h3>
						</div>
                       <?php
									// Getting the full url of the current page
									$final_url = BASE_URL.URL_NEWS.$_REQUEST['slug'];
									?>
									<!-- Facebook Comment Main Code (got from facebook website) -->
									<div class="fb-comments" data-href="<?php echo $final_url; ?>" data-numposts="5"></div>
                    </div>
                    <!-- Comment-End -->
                </main>
                <?php require_once('includes/sidebar.php'); ?>
			</div>
        </div>					
				<?php require_once('includes/footer.php'); ?>