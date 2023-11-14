<?php
require_once('includes/news-meta.php');

// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: '.BASE_URL);
	exit;
}
else
{
	// Check the page slug is valid or not.
	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=? AND status=?");
	$statement->execute(array($_REQUEST['slug'],'Active'));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}

// Getting the detailed data of a page from page slug
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$page_name    = $row['page_name'];
	$page_slug    = $row['page_slug'];
	$page_content = $row['page_content'];
	$page_layout  = $row['page_layout'];
	$status       = $row['status'];
}

// If a page is not active, redirect the user while direct URL press
if($status == 'Inactive')
{
	header('location: '.BASE_URL);
	exit;
}
?>
	<?php if($page_layout == 'Full Width Page Layout'): ?>
	<div class="full-width-content">
		<div class="site-inner">
            <div class="content-sidebar-wrap">
			
                <main class="content">
                    <article class="page type-page entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo $page_name; ?></h1>
                        </header>
                        <div class="entry-content" itemprop="text">
                         <?php echo $page_content; ?>   
                        </div>
                    </article>
                </main>
			</div>
		</div>
	</div>
				<?php endif; ?>
				
<?php if($page_layout == 'Photo Gallery Page Layout'): ?>				
	<div class="site-inner">
            <div class="content-sidebar-wrap">
			
                <main class="content">
				<div class="archive-description posts-page-description">
                        <h1 class="archive-title"><?php echo $page_name; ?></h1>
                    </div>
                    <div class=" entry" >

                     
						
<section class="gallery">													
					<div class="col-sm-12">
						<?php
						$statement = $pdo->prepare("SELECT * FROM tbl_category_photo WHERE status=? ORDER BY p_category_id DESC");
						$statement->execute(array('Active'));
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result as $row) 
						{
							?><div class="clear"></div><h3><?php echo $row['p_category_name']; ?></h3><?php

							$statement1 = $pdo->prepare("SELECT * FROM tbl_photo WHERE p_category_id=? ORDER BY photo_id DESC");
							$statement1->execute(array($row['p_category_id']));
							$result1 = $statement1->fetchAll();
							foreach ($result1 as $row1) 
							{
								?>
								<div class="item">
									<div class="inner">
										<a class="gallery-photo" href="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row1['photo_name']; ?>" title="<?php echo $row1['photo_caption']; ?>"><div class="photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/<?php echo $row1['photo_name']; ?>);">
										</div></a>
										
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>					
				</section>							
						
						
						
						
                    </div>
                 </main>
				<?php require_once('includes/sidebar.php'); ?>
			</div>
		</div>
<?php endif; ?>
<?php if($page_layout == 'Video Gallery Page Layout'): ?>
<div class="site-inner">
            <div class="content-sidebar-wrap">
			
                <main class="content">
				<div class="archive-description posts-page-description">
                        <h1 class="archive-title"><?php echo $page_name; ?></h1>
                    </div>
                    <div class=" entry" >
				<section class="gallery">													
					<div class="video">
						<?php
						$statement = $pdo->prepare("SELECT * FROM tbl_category_video WHERE status=? ORDER BY v_category_id DESC");
						$statement->execute(array('Active'));
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result as $row) 
						{
							?><div class="clear"></div><h3><?php echo $row['v_category_name']; ?></h3><?php

							$statement1 = $pdo->prepare("SELECT * FROM tbl_video WHERE v_category_id=? ORDER BY video_id DESC");
							$statement1->execute(array($row['v_category_id']));
							$result1 = $statement1->fetchAll();
							foreach ($result1 as $row1) 
							{
								?>
								<div class="">
									<div class="inner">
										<div class="video-iframe">
											<?php
												echo $row1['video_iframe'];
											?>
										</div>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>					
				</section>	
						
						
                    </div>
                 </main>
				<?php require_once('includes/sidebar.php'); ?>
			</div>
		</div>
<?php endif; ?>	
		<?php if($page_layout == 'Content Width Sidebar Layout'): ?>

		<div class="site-inner">
            <div class="content-sidebar-wrap">
			
                <main class="content">
                    <article class="page type-page entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo $page_name; ?></h1>
                        </header>
                        <div class="entry-content" itemprop="text">
                         <?php echo $page_content; ?>   
                        </div>
                    </article>
                </main>
				<?php require_once('includes/sidebar.php'); ?>
			</div>
		</div>

				<?php endif; ?>
				
				<?php if($page_layout == 'Contact Us Page Layout'): ?>
<?php
	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) 
	{
		$contact_map_iframe = $row['contact_map_iframe'];
	}
?>		<div class="site-inner">
            <div class="content-sidebar-wrap">
				<main class="content">
                    <article class="page type-page entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo CONTACT_FORM; ?></h1>
                        </header>
                        <div class="entry-content" itemprop="text">
                         <?php
// After form submit checking everything for email sending
if(isset($_POST['form_contact']))
{
	$error_message = '';
	$success_message = '';
	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) 
	{
		$receive_email = $row['receive_email'];
		$receive_email_subject = $row['receive_email_subject'];
		$receive_email_thank_you_message = $row['receive_email_thank_you_message'];
	}

    $valid = 1;

    if(empty($_POST['visitor_name']))
    {
        $valid = 0;
        $error_message .= FULL_NAME_EMPTY_CHECK.'\n';
    }

    if(empty($_POST['visitor_phone']))
    {
        $valid = 0;
        $error_message .= PHONE_EMPTY_CHECK.'\n';
    }


    if(empty($_POST['visitor_email']))
    {
        $valid = 0;
        $error_message .= EMAIL_EMPTY_CHECK.'\n';
    }
    else
    {
    	// Email validation check
        if(!filter_var($_POST['visitor_email'], FILTER_VALIDATE_EMAIL))
        {
            $valid = 0;
            $error_message .= EMAIL_VALID_CHECK.'\n';
        }
    }

    if(empty($_POST['visitor_comment']))
    {
        $valid = 0;
        $error_message .= COMMENT_EMPTY_CHECK.'\n';
    }

    if($valid == 1)
    {
		
		$visitor_name = strip_tags($_POST['visitor_name']);
		$visitor_email = strip_tags($_POST['visitor_email']);
		$visitor_phone = strip_tags($_POST['visitor_phone']);
		$visitor_comment = strip_tags($_POST['visitor_comment']);

        // sending email
		$to_admin = $receive_email;
        $subject = $receive_email_subject;

        $message = '
<html><body>
<table>
<tr>
<td>Name</td>
<td>'.$visitor_name.'</td>
</tr>
<tr>
<td>Email</td>
<td>'.$visitor_email.'</td>
</tr>
<tr>
<td>Phone</td>
<td>'.$visitor_phone.'</td>
</tr>
<tr>
<td>Comment</td>
<td>'.nl2br($visitor_comment).'</td>
</tr>
</table>
</body></html>
';

		try {
		    
		    $mail->setFrom($visitor_email, $visitor_name);
		    $mail->addAddress($to_admin, 'Admin');
		    $mail->addReplyTo($visitor_email, $visitor_name);
		    
		    $mail->isHTML(true);
		    $mail->Subject = $subject;
  
		    $mail->Body = $message;
		    $mail->send();

		    $success_message = $receive_email_thank_you_message;    
		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

    }
}
?>
				
				<?php
				if($error_message != '') {
					echo "<script>alert('".$error_message."')</script>";
				}
				if($success_message != '') {
					echo "<script>alert('".$success_message."')</script>";
				}
				?>


				<form action="<?php echo BASE_URL.URL_PAGE.$_REQUEST['slug']; ?>" class="form-horizontal cform-1" method="post">
					<div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="<?php echo FULL_NAME; ?>" name="visitor_name">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="visitor_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="visitor_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea name="visitor_comment" class="form-control" cols="30" rows="10" placeholder="<?php echo MESSAGE; ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
	                    <div class="col-sm-12">
	                        <input type="submit" value="<?php echo SEND_MESSAGE; ?>" class="btn btn-success" name="form_contact">
	                    </div>
	                </div>
				</form> 
                        </div>
                    </article>
					<section class="after-entry widget-area">
                         <div class="widget widget-wrap">
                            <div class="google-map">
								<?php echo $contact_map_iframe; ?>
							</div> 		
                        </div>
                    </section>
					</main>
					<?php require_once('includes/sidebar.php'); ?>
                
			</div>
		</div>		
				<?php endif; ?>
				
				<?php if($page_layout == 'FAQ Page Layout'): ?>
		<div class="site-inner">
            <div class="content-sidebar-wrap">
				<main class="content">
                    <article class="page type-page entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php echo $page_name; ?></h1>
                        </header>
                        <div class="entry-content" itemprop="text">
                         <?php
				$i=0;
				$j=0;
				$statement = $pdo->prepare("SELECT * FROM tbl_faq_category ORDER BY faq_category_id ASC");
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
				foreach ($result as $row) {
					$i++;
					?>
					<h1><?php echo $row['faq_category_name']; ?></h1>
					<div class="panel-group" id="accordion<?php echo $i; ?>" role="tablist" aria-multiselectable="true">
						<?php
						$statement1 = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_category_id=?");
						$statement1->execute(array($row['faq_category_id']));
						$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result1 as $row1) {
							$j++;
							?>
			
			<div class="panel panel-default">
				<a data-toggle="collapse" class="collapsible" data-parent="#accordion<?php echo $i; ?>" href="#collapse<?php echo $j; ?>" aria-expanded="false">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo $row1['faq_title']; ?><i class="pull-right glyphicon glyphicon-plus"></i><i class="pull-right glyphicon glyphicon-minus"></i></h4>
					</div>
				</a>
				<div class="panel-collapse collapse " id="#collapse<?php echo $j; ?>">
					<div class="panel-body white-box white-box">
					<?php echo $row1['faq_content']; ?>

					</div>
				</div>
			</div> 

							<?php
						}
						?>
					</div>
					<?php
				}
				?>			  
                        </div>
                    </article>
					</main>
					<?php require_once('includes/sidebar.php'); ?>
                
			</div>
		</div>	
				<?php endif; ?>
				
				<?php if($page_layout == 'Blog Page Layout'): ?>
		<div class="site-inner">
            <div class="content-sidebar-wrap">
				<main class="content">
                    <div class="archive-description posts-page-description">
                        <h1 class="archive-title"><?php echo $page_name; ?></h1>
                    </div>
					<?php
							$statement = $pdo->prepare("SELECT * FROM tbl_news ORDER BY news_id DESC");
							$statement->execute();
							$total = $statement->rowCount();
							?>

							<?php if(!$total): ?>
							<p style="color:red;"><?php echo NEWS_EMPTY_CHECK; ?></p>
							<?php else: ?>
							
				<?php
/* ===================== Pagination Code Starts ================== */
		$adjacents = 10;	
		
		$statement = $pdo->prepare("SELECT * FROM tbl_news ORDER BY news_id DESC");
		$statement->execute();
		$total_pages = $statement->rowCount();
		
		$targetpage = $_SERVER['PHP_SELF'];
		$limit = 5;                                 
		$page = @$_GET['page'];
		if($page) 
			$start = ($page - 1) * $limit;          
		else
			$start = 0;	
		

		$statement = $pdo->prepare("SELECT
								   t1.news_title,
		                           t1.news_slug,
		                           t1.news_content,
		                           t1.news_date,
		                           t1.photo,
								   t1.publisher,
		                           t1.category_id,

		                           t2.category_id,
		                           t2.category_name,
		                           t2.category_slug
		                           FROM tbl_news t1
		                           JOIN tbl_category t2
		                           ON t1.category_id = t2.category_id 		                           
		                           ORDER BY t1.news_id 
		                           LIMIT $start, $limit");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		
		$s1 = $_REQUEST['slug'];
				
		if ($page == 0) $page = 1;                  
		$prev = $page - 1;                          
		$next = $page + 1;                          
		$lastpage = ceil($total_pages/$limit);      
		$lpm1 = $lastpage - 1;   
		$pagination = "";
		if($lastpage > 1)
		{   
			
			$pagination .= "<div class=\"archive-pagination pagination\" role=\"navigation\" aria-label=\"Pagination\"><ul>";
			if ($page > 1) 
				$pagination.= "<li><a href=\"$targetpage?slug=$s1&page=$prev\">&#171;</a></li>";
			else
				$pagination.= "";    
			if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
			{   
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><span class=\"current\"><a href=\"$targetpage?slug=$s1&page=$counter\">$counter</a></span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?slug=$s1&page=$counter\">$counter</a></li>";                 
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
			{
				if($page < 1 + ($adjacents * 2))        
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><span class=\"current\">$counter</span></li>";
						else
							$pagination.= "<li class=\"active\"><a href=\"$targetpage?slug=$s1&page=$counter\">$counter</a></li>";                 
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=$lastpage\">$lastpage</a>";       
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><span class=\"current\">$counter</span></li>";
						else
							$pagination.= "<a href=\"$targetpage?slug=$s1&page=$counter\">$counter</a>";                 
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=$lastpage\">$lastpage</a>";       
				}
				else
				{
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage?slug=$s1&page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><span class=\"current\">$counter</span></li>";
						else
							$pagination.= "<a href=\"$targetpage?slug=$s1&page=$counter\">$counter</a>";                 
					}
				}
			}
			if ($page < $counter - 1) 
				$pagination.= "<li class=\"pagination-next\"><a href=\"$targetpage?slug=$s1&page=$next\"> &#187;</a></li>";
			else
				$pagination.= "";
			$pagination.= "</ul></div>\n";       
		}
		/* ===================== Pagination Code Ends ================== */
		?>

							<?php
							foreach ($result as $row) {
								?>
					<article class=" post entry" itemscope itemtype="https://schema.org/CreativeWork">
                        <header class="entry-header">
                            <h2 class="entry-title" itemprop="headline"><a class="entry-title-link" rel="bookmark" href="<?php echo BASE_URL.URL_NEWS.$row['news_slug']; ?>"><?php echo $row['news_title']; ?></a></h2>
                            <p class="entry-meta"><span class="entry-author" itemprop="author" itemscope itemtype="https://schema.org/Person">By: <span class="entry-author-name" itemprop="name"><?php echo $row['publisher']; ?></span>
                                </span><span class="entry-categories">In: <a href="<?php echo BASE_URL.URL_CATEGORY.$row['category_slug']; ?>" rel="category tag"><?php echo $row['category_name']; ?></a></span><time class="entry-time" itemprop="datePublished" datetime="<?php echo $row['news_date']; ?>">Published on: <?php echo $row['news_date']; ?></time></p>
                        </header>
                        <div class="entry-content" itemprop="text"><a class="entry-image-link" href="<?php echo BASE_URL.URL_NEWS.$row['news_slug']; ?>" aria-hidden="true" tabindex="-1"><img width="700" height="394" src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row['photo']; ?>" class="aligncenter post-image entry-image" alt="pinterest facts" itemprop="image"/></a>
                            <p><?php echo substr($row['news_content'],0,200).' ...'; ?> </p>
                        </div>
                        <footer class="entry-footer">
                            <p class="entry-meta"><a class="read-more-link btn" href="<?php echo BASE_URL.URL_NEWS.$row['news_slug']; ?>" title="Read More">Read More »</a></p>
                        </footer>
                    </article>
					<?php
							}
							?>							
							<?php endif; ?>			
								
								
					
							<?php if($total): ?>
							<?php echo $pagination; ?>
							<?php endif; ?>
                 </main>   
					<?php require_once('includes/sidebar.php'); ?>
                
            </div>
        </div>
		<?php endif; ?>
		<?php require_once('includes/footer.php'); ?>