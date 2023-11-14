<?php require_once('includes/news-meta.php'); ?>
        		<div class="site-inner">
            <div class="content-sidebar-wrap">
				<main class="content">
                    <div class="archive-description posts-page-description">
                        <h1 class="archive-title">News</h1>
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
				$pagination.= "<li><a href=\"?page=$prev\">&#171;</a></li>";
			else
				$pagination.= "";    
			if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
			{   
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><span class=\"current\"><a href=\"?page=$counter\">$counter</a></span></li>";
					else
						$pagination.= "<li><a href=\"?page=$counter\">$counter</a></li>";                 
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
							$pagination.= "<li class=\"active\"><a href=\"?page=$counter\">$counter</a></li>";                 
					}
					$pagination.= "...";
					$pagination.= "<a href=\"?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"?page=$lastpage\">$lastpage</a>";       
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"?page=1\">1</a>";
					$pagination.= "<a href=\"?page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><span class=\"current\">$counter</span></li>";
						else
							$pagination.= "<a href=\"?page=$counter\">$counter</a>";                 
					}
					$pagination.= "...";
					$pagination.= "<a href=\"?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"?page=$lastpage\">$lastpage</a>";       
				}
				else
				{
					$pagination.= "<a href=\"?page=1\">1</a>";
					$pagination.= "<a href=\"?page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><span class=\"current\">$counter</span></li>";
						else
							$pagination.= "<a href=\"?page=$counter\">$counter</a>";                 
					}
				}
			}
			if ($page < $counter - 1) 
				$pagination.= "<li class=\"pagination-next\"><a href=\"?page=$next\"> &#187;</a></li>";
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
				<?php require_once('includes/footer.php'); ?>
				