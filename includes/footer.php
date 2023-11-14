<?php
$statement = $pdo->prepare("SELECT * FROM tbl_theme WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$footer_title_1					= $row['footer_title_1'];
	$footer_title_2					= $row['footer_title_2'];
	$footer_title_3					= $row['footer_title_3'];
	$footer_content_1				= $row['footer_content_1'];
	$footer_content_2				= $row['footer_content_2'];
	$footer_content_3				= $row['footer_content_3'];
	$copyright_text					= $row['copyright_text'];
	
}
?>

<?php if($footer_status=='Show'): ?>	
 <div class="footer-widgets">
        <h2 class="screen-reader-text">Footer</h2>
        <div class="wrap">
            <div class="widget-area footer-widgets-1 footer-widget-area">
                <section class="widget">
                    <div class="widget-wrap">
                        <h3 class="widget-title"><?php echo $footer_title_1; ?></h3>
						
                        
							<?php echo $footer_content_1; ?>
						
                       
                    </div>
                </section>
            </div>
            <div class="widget-area footer-widgets-2 footer-widget-area">
                <section class="widget">
                    <div class="widget-wrap">
                        <h3 class="widget-title"><?php echo $footer_title_2; ?></h3>
                        <?php echo $footer_content_2; ?>
                    </div>
                </section>
            </div>
            <div class="widget-area footer-widgets-3 footer-widget-area">
                <section  class=" widget">
                    <div class="widget-wrap">
                        <h3 class=" widget-title"><?php echo $footer_title_3; ?></h3>
                            <?php echo $footer_content_3; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
	<div class="back-top"> <a href="#"><i class="fa fa-angle-double-up"></i></a> </div>
	<?php endif; ?>
	<div style="overflow:hidden">
<svg class="svghook" xmlns="http://www.w3.org/2000/svg" viewBox="0 250 2000 170" preserveAspectRatio="none">
<path d="M1919.16,381.161c-47.52.211-52.83,3.175-52.83,3.175s-8.27,1.9-8.27-4.446c-0.11-7.091,1.06-13.759-3.18-13.97s0.42,12.912-7.64,12.7c-14.75,0-.85-78.532-10.18-78.744s12.94,86.365-23.55,86.365c-12.63,0,1.27-20.321-8.92-20.321s1.17,19.792-7,22.861c-8.48,2.752-56.65,5.715-87.2-6.35s-41.37-18.2-75.1-16.511-27.16,9.525-44.56,8.89c-10.61-.423-0.21-31.752-7-31.752-5.73,0,2.54,23.5-12.09,23.5-25.25,0-2.55-71.124-15.92-71.124-8.7,0,9.18,77.474-19.73,77.474-32.88,0-10.39-55.248-21-55.248s13.03,43.817-25.01,43.817c-23.13,0-10.18-14.6-17.19-14.6s5.63,14.6-10.82,14.6c-18.03,0,.64-53.343-8.91-53.343s7.14,51.438-24.64,51.438c-21.74,0-2.12-64.773-12.09-64.773s5.41,72.394-12.09,72.394c-26.26,0-8.07-17.781-17.83-17.781s13.01,23.5-31,23.5c-18.25,0,2.12-74.3-10.18-74.3s15.48,90.175-29.92,90.175c-42.59,0-89.18-8.909-105.32-18.577-15.48-9.567,7.21-86.2-7.64-86.2s4.88,77.792-17.82,78.109c-16.55-.1-2.55-25.4-12.1-25.4s10.82,24.978-14,27.942c-12.94,1.481-12.09-12.7-51.56-12.7s-47.52,22.12-73.19,26.036c-28.12,3.916-61.214,2.011-73.838,0-14.321-3.175.849-24.131-8.911-24.131s6.153,20.956-8.911,20.956c-35.114,0-10.184-85.73-22.914-85.73s5.2,78.745-7.638,78.745c-13.9,0-1.91-12.066-9.548-12.066s4.486,17.781-5.092,17.781c-10.214,0-7-4.445-18.458-4.445s-6.789,11.431-17.186,11.431-3.606-3.811-22.914-3.811S823.207,394.5,795.625,394.5s-25.46-14.606-54.1-14.606-23.974,8.891-66.832,8.891c-45.4,0-17.61-90.175-29.916-90.175s8.063,74.3-10.184,74.3c-31.347,0-11.244-23.5-21-23.5s8.434,17.781-17.822,17.781c-17.5,0-2.122-72.394-12.094-72.394s9.654,64.773-12.093,64.773c-21.111,0-5.092-51.438-14.64-51.438s6.79,53.343-8.911,53.343c-16.442,0-3.819-14.6-10.82-14.6s5.941,14.6-17.186,14.6c-48.374,0-24.4-43.817-35.007-43.817s11.881,55.248-21,55.248c-28.907,0-11.032-77.474-19.731-77.474-13.367,0,9.335,71.124-15.913,71.124-14.639,0-6.365-23.5-12.093-23.5-6.789,0,3.607,31.329-7,31.752-17.4.635-10.82-7.2-44.555-8.89s-44.555,4.445-75.107,16.511-78.713,9.1-87.2,6.35c-8.168-3.069,3.182-22.861-7-22.861s3.713,20.321-8.911,20.321c-36.492,0-14.215-86.577-23.55-86.365s4.562,78.744-10.184,78.744c-8.062.212-3.395-12.912-7.638-12.7s-3.077,6.879-3.183,13.97c0,6.351-8.274,4.446-8.274,4.446s-5.3-2.964-52.829-3.175S17.5,386.082,0,391.321V458H2000V391.321C1982.5,386.082,1966.69,380.949,1919.16,381.161Z"></path>
</svg>
</div>
    <footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        <div class="wrap">
            <p><span class="credit"><?php echo $copyright_text; ?></span>
				<span class="credit-link">
			<?php
                                $q = $pdo->prepare("SELECT * FROM tbl_footer_menu WHERE footer_menu_parent=? ORDER BY footer_menu_order ASC");
                                $q->execute(array(0));
                                $res = $q->fetchAll();
                                foreach ($res as $row) {
                                    
                                    $r = $pdo->prepare("SELECT * FROM tbl_footer_menu WHERE footer_menu_order=?");
                                    $r->execute(array($row['menu_id']));
                                    $total = $r->rowCount();

                                    
                                    
                                    if($row['page_id'] == 0) {
                                        
                                        if($row['footer_menu_url'] == '') {
                                            $final_url = 'javascript:void(0);';
                                        } else {
                                            $final_url = $row['footer_menu_url'];
                                        }                                       
                                        ?>
                                        <a href="<?php echo $final_url; ?>"><?php echo $row['footer_menu_name']; ?><?php if($total) {echo '<em></em>';}; ?></a>
                                        <?php
                                    } else {
                                        $r = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=? ");
                                        $r->execute(array($row['page_id']));
                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            ?>
                                            <a href="<?php echo BASE_URL.URL_PAGE.$row1['page_slug']; ?>"><?php echo $row1['page_name']; ?></a>
                                            <?php
                                        }
                                    }

                                  

                                }
                                ?>
				</span>
			</p>
        </div>
    </footer>
    </div>
<script src="<?php echo BASE_URL; ?>assets/js/clipboard.min.js"></script>    
<script>window.onscroll = function(){var e = document.getElementsByClassName("site-container"); window.pageYOffset > 300 ? e[0].classList.add("fixed") : e[0].classList.remove("fixed");}</script><script>var x = document.body.querySelectorAll('.menu-item-has-children>a');var index = 0;for (index = 0; index < x.length; index++){var navArrow = document.createElement('span');navArrow.className = 'sub-menu-toggle';navArrow.innerHTML = '<b></b>';
x[index].parentNode.insertBefore(navArrow, x[index].nextSibling);}var elements = document.querySelectorAll('.sub-menu-toggle');for (var i in elements){if (elements.hasOwnProperty(i)){elements[i].onclick = function() {this.parentElement.querySelector('.sub-menu').classList.toggle("active");this.parentElement.querySelector('.sub-menu-toggle').classList.toggle("activated");}}}</script>
<script>var coll=document.getElementsByClassName("collapsible");var i;for(i=0;i<coll.length;i++){coll[i].addEventListener("click",function(){this.classList.toggle("active");var collapse=this.nextElementSibling;if(collapse.style.display==="block"){collapse.style.display="none"}else{collapse.style.display="block"}})}</script>
<script type="text/javascript">
var btns = document.querySelectorAll('button');var clipboard = new Clipboard(btns);function copy(e){var btns = document.querySelectorAll('button');var clipboard = new Clipboard(btns);e.innerHTML='Copied!'; 
}</script>
</body>

</html>
<?php echo ob_get_clean(); ?>