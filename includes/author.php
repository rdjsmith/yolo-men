<div class="row">
	<div class="twelve columns">
		<div class="row">
			<div class="two columns ">
				<div class="author-avartar">
					<?php echo get_avatar( get_the_author_meta('ID'), 150 ); ?>
				</div>
			</div>
			<div class="ten columns">
				<?php
					$author_name = get_the_author_meta('display_name');
					$user_login = get_the_author_meta('user_login');
					$website = get_the_author_meta('url');
					
					$facebook = get_the_author_meta('facebook');
					$twitter = get_the_author_meta('twitter');
					$gplus = get_the_author_meta('gplus');
				?>
				<p class="author-title">by <?php echo $author_name; ?></p>
				<div class="author-info">
					<p><?php echo get_the_author_meta('description'); ?></p>
					<p><strong>View all contributions by <?php the_author_posts_link(); ?></strong></p>
					
					<?php if( ! empty( $website ) ) { ?>
						<p><strong>Website: </strong> <a href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
					<?php } ?>
					
					<p>
						<?php if( ! empty( $facebook ) ) { ?>
							<a href="<?php echo $facebook; ?>" target="_blank">Facebook</a>
						<?php } ?>
						
						<?php if( ! empty( $twitter ) ) { ?>
							<a href="<?php echo $twitter; ?>" target="_blank">Twitter</a>
						<?php } ?>
						
						<?php if( ! empty( $gplus ) ) { ?>
							<a href="<?php echo $gplus; ?>" target="_blank">Google Plus</a>
						<?php } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>