<div class="row">
	<div class="twelve columns">	
		<h3 class="social-title">Shares this article — thank you, guys!</h3>
		<ul class="no-bullet">
			<?php 
				$social_path = get_stylesheet_directory_uri() . '/images/icons';
				
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src( $image_id );
				$media_url = $image_url[0];
			?>
			<li><a href="http://www.facebook.com/share.php?u=<?php echo esc_url( get_permalink() ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><img src="<?php echo $social_path; ?>/facebook.png" alt="Facebook" /></a></li>
			<li><a href="http://twitter.com/home?status=<?php echo get_the_title() .' '. esc_url( get_permalink() ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><img src="<?php echo $social_path; ?>/twitter.png" alt="Twitter" /></a></li>
			<li><a href="http://delicious.com/post?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>" target="_blank"><img src="<?php echo $social_path; ?>/delicious.png" alt="Delicious" /></a></li>
			<li><a href="http://digg.com/submit?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>" target="_blank"><img src="<?php echo $social_path; ?>/digg.png" alt="Digg" /></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><img src="<?php echo $social_path; ?>/google-plus.png" alt="Google Plus" /></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><img src="<?php echo $social_path; ?>/linkedin.png" alt="Linkedin" /></a></li>
			<li><a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><img src="<?php echo $social_path; ?>/my-space.png" alt="My Space" /></a></li>
			<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&media=<?php echo esc_url( $media_url ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><img src="<?php echo $social_path; ?>/pinterest.png" alt="Pinterest" /></a></li>
			<li><a href="http://reddit.com/submit?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>" target="_blank"><img src="<?php echo $social_path; ?>/reddit.png" alt="Reddit" /></a></li>
			<li><a href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>" target="_blank"><img src="<?php echo $social_path; ?>/stumble-upon.png" alt="Stumble Upon" /></a></li>
		</ul>
	</div>
</div>