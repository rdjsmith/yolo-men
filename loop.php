<?php
global $data;

if ( have_posts() ) : ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php if( is_home() || is_category() || is_archive() ) { ?>
			
				<?php
					if( 2 == $data['rsclean_blog_layout'] ) {
						$column_class = 'six columns masonry';
						$image_size = 'medium-thumbnail';
					} else {
						$column_class = 'twelve columns blog-full';
						$image_size = 'full';
					}
				?>
				<div class="<?php echo $column_class; ?>">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2 class="entryTitle">
							<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', THEME_DOMAIN), get_the_title()) ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
						<?php
							if( $data['rsclean_enable_postmeta'] )
								include( POST_INFO );
						?>
						
						<?php if( has_post_thumbnail() ) { ?>
							<div class="blogMediaWrapper">
								<div class="textCenter">
									<figure>
										<?php
											$attr = array(
												'class'	=> "blog-attachment-media",
												'alt'	=> trim(strip_tags( get_the_title() ))
											);
											echo '<a href="'. esc_url( get_permalink() ).'">'.get_the_post_thumbnail( get_the_ID(), $image_size, $attr ).'</a>';
										?>
									</figure>
								</div>
							</div>
						<?php } ?>
						
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
					</article>
					
				</div>
				
			<?php } else { ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entryTitle">
						<a href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s', THEME_DOMAIN), get_the_title()) ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h2>
					<?php
						if( $data['rsclean_enable_postmeta'] )
							include( POST_INFO );
					?>
					
					<?php if( has_post_thumbnail() ) { ?>
						<div class="blogMediaWrapper">
							<?php
								$attr = array(
									'class'	=> "blog-attachment-media",
									'alt'	=> trim(strip_tags( get_the_title() ))
								);
								echo '<a href="'. esc_url( get_permalink() ).'">'.get_the_post_thumbnail( get_the_ID(), 'full', $attr ).'</a>';
							?>
						</div>
					<?php } ?>
					
					<div class="entry">
	                	<?php the_content( "Read More"); ?>
	               	</div>
				</article>
				
			<?php } ?>
		
		<?php endwhile; ?>
		
	<?php 
		if(function_exists('wp_paginate')) {
			wp_paginate();
		} else {
			include( NAVIGATION );
		}
	?>
	
<?php else: ?>

	<h2><?php _e( 'No content found', THEME_DOMAIN ); ?></h2>
	<p><?php _e( 'Sorry but we don\'t have enough post yet to dipslay at the moment.', THEME_DOMAIN ); ?></p>
	
<?php endif; ?>