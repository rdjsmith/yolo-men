				<?php global $data; ?>
				
				</main> <!--<div role="main" id="main">-->
			
			<footer id="footer" role="footer">
				<div class="row">
					<?php for( $i = 1; $i <= 3; $i++ ) { ?>
						<div class="four mobile-two columns">
							<?php
								if ( is_active_sidebar( 'footer-'. $i ) )
									dynamic_sidebar( 'footer-'. $i );
								
								if( 1 == $i ) { ?>
									<h3 class="widgetTitle">Lets Get Social, YOLO</h3>
									
									<div class="socialSharing">
										<?php if( $data['rsclean_facebook_username'] ) { ?>
											<a href="http://facebook.com/<?php echo $data['rsclean_facebook_username']; ?>" target="_blank" class="facebook" title="Facebook">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/facebook-icon.png" alt="Facebook" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_twitter_username'] ) { ?>
											<a href="http://twitter.com/<?php echo $data['rsclean_twitter_username']; ?>" target="_blank" class="twitter" title="Twitter">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/twitter-icon.png" alt="Twitter" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_instagram_username'] ) { ?>
											<a href="http://instagram.com/<?php echo $data['rsclean_instagram_username']; ?>" target="_blank" class="instagram" title="Instagram">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/instagram-icon.png" alt="Instagram" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_pinterest_username'] ) { ?>
											<a href="http://pinterest.com/<?php echo $data['rsclean_pinterest_username']; ?>" target="_blank" class="pinterest" title="Pinterest">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/pinterest-icon.png" alt="Pinterest" />
											</a>
										<?php } ?>
											
										
										<?php if( $data['rsclean_googleplus_url'] ) { ?>
											<a href="<?php echo $data['rsclean_googleplus_url']; ?>" target="_blank" class="gplus" title="Google+">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/g-plus-icon.png" alt="Google Plus" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_flickr_username'] ) { ?>
											<a href="http://flickr.com/people/<?php echo $data['rsclean_flickr_username']; ?>" target="_blank" class="flickr" title="Flickr">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/flickr-icon.png" alt="Flickr" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_youtube_username'] ) { ?>
											<a href="http://youtube.com/user/<?php echo $data['rsclean_youtube_username']; ?>" target="_blank" class="youtube" title="Youtube">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/youtube-icon.png" alt="Youtube" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_vimeo_username'] ) { ?>
											<a href="http://vimeo.com/<?php echo $data['rsclean_vimeo_username']; ?>" target="_blank" class="vimeo" title="Vimeo">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/vimeo-icon.png" alt="Vimeo" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_digg_username'] ) { ?>
											<a href="http://digg.com/<<?php echo $data['rsclean_digg_username']; ?>" target="_blank" class="digg" title="Digg">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/digg-icon.png" alt="Digg" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_dribble_username'] ) { ?>
											<a href="http://dribbble.com/<?php echo $data['rsclean_dribble_username']; ?>" target="_blank" class="dribble" title="Dribble">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/dribble-icon.png" alt="Dribble" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_linkedin_username'] ) { ?>
											<a href="<?php echo $data['rsclean_linkedin_username']; ?>" target="_blank" class="linkedin" title="Linkedin">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/linkedin-icon.png" alt="Linkedin" />
											</a>
										<?php } ?>
										
										<?php if( $data['rsclean_tumblr_username'] ) { ?>
											<a href="<?php echo $data['rsclean_tumblr_username']; ?>" target="_blank" class="thumblr" title="Tumblr">
												<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/tumblr-icon.png" alt="Tumblr" />
											</a>
										<?php } ?>
										
									</div>
									<div class="clear"></div>
								<?php } ?>
						</div>
					<?php } ?>
				</div>
			</footer>
				
		</div> <!--<div class="wrapper">-->
		
		<?php
			/* Always have wp_footer() just before the closing </body>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to reference JavaScript files.
			 */
			
			wp_footer();
			
			echo $data['rsclean_ga_code'];
		?>
		
	</body>
</html>