
<?php
$shareURL = urlencode( currentUrl());
$shareTitle = str_replace( ' ', '%20', $pageTitle);
?>						
						<footer class="entry-footer">
                            <div class="socialshare">
                                <div class="social-share inline"><span class="sharetitle">Share</span>
                                    <ul class="share-list">
                                        <li class="icon facebook"><a rel="external nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareURL; ?>" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i><span>Share on Facebook</span></a></li>
                                        <li
                                            class="icon twitter"><a rel="external nofollow" href="https://twitter.com/intent/tweet?text=<?php echo $shareTitle; ?>&amp;url=<?php echo $shareURL; ?>&amp"
                                                target="_blank" title="Tweet on Twitter"><i class="fa fa-twitter"></i><span>Tweet on Twitter</span></a></li>
                                            <li class="icon linkedin"><a rel="external nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareURL; ?>&amp;title=<?php echo $shareTitle; ?>"
                                                    target="_blank" title="Share on Linkedin"><i class="fa fa-linkedin"></i><span>Share on Linkedin</span></a></li>
                                            <li class="icon email"><a rel="external nofollow" href="mailto:?Subject=<?php echo $pageTitle; ?>&body=<?php echo $shareURL; ?>"
                                                    title="Share via Mail"><i class="fa fa-mail"></i></a></li>
                                            <li class="icon whatsapp"><a rel="external nofollow" href="https://api.whatsapp.com/send?text=<?php echo $shareTitle; ?> <?php echo $shareURL; ?>"
                                                    target="_blank" title="Share on WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                                <div class="social-share flt hide">
                                    <div class="flt-bar"><input type="checkbox" id="share-toggle">
                                        <div class="flt-bar-button">
                                            <ul class="float-list">
                                                <li class="icon facebook"><a rel="external nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareURL; ?>" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i></li><li class="icon twitter"><a rel="external nofollow" href="https://twitter.com/intent/tweet?text=<?php echo $shareTitle; ?>&amp;url=<?php echo $shareURL; ?>&amp" target="_blank" title="Tweet on Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li
                                                    class="icon email"><a rel="external nofollow" href="mailto:?Subject=<?php echo $pageTitle; ?>&body=<?php echo $shareURL; ?>"
                                                        title="Share via Mail"><i class="fa fa-mail"></i></a></li>
                                                    <li class="icon linkedin"><a rel="external nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareURL; ?>&amp;title=<?php echo $shareTitle; ?>"
                                                            target="_blank" title="Share on Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul><label for="share-toggle" class="share-toggle"><span></span></label></div>
                                    </div>
                                </div>
                            </div>
                        </footer>