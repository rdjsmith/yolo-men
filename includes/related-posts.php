<div class="row">	
	<div class="twelve columns">
		<h3 class="related-title">Related Articles</h3>
	</div>
	
	<div class="twelve columns">
		<div class="row related-posts">
			<?php
				$tags = wp_get_post_tags( $post->ID );
				$tag_slugs = array();
				
				if( $tags ){
					foreach( $tags as $tag )
						$tag_slugs[] = $tag->slug;
				}
				
				if ( $tags )
				{
					$args = array(
						'tag_slug__and' 		=> $tag_slugs,
						'post__not_in' 			=> array( get_the_ID() ),
						'post_count'			=> 4,
						'ignore_sticky_posts'	=> true
					);
					$the_query = new WP_Query( $args );
					
					if( $the_query->have_posts() ) 
					{
						while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="three columns">
								<div class="blog-wrapper">
									<?php
										if ( has_post_thumbnail() ) 
										{
											$attr = array(
												'class'	=> "blog-attachment-media",
												'alt'	=> trim(strip_tags( get_the_title() )),
												'title'	=> trim(strip_tags( get_the_title() ))
											);
											
											echo '<a href="'. get_permalink() .'">' . get_the_post_thumbnail( get_the_ID(), 'medium-thumbnail', $attr ) . '</a>';
										} else {
											?>
												<!-- if no featured and image content then display no image -->
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
													<img src="<?php echo get_bloginfo('template_directory'); ?>/images/no-image.jpg" alt="<?php echo esc_attr( get_the_title() ); ?>" height="40" class="blog-attachment-media wp-post-image" />
												</a>
											<?php
										}
									?>
								</div>
								<h4 class="related-post-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
							</div>
						<?php 
						endwhile;
						
					} else {
					
						?>
							<div class="twelve columns">
								<p>The current post has no related post(s)</p>
							</div>
						<?php
					}
				}

				/* Restore original Post Data */
				wp_reset_postdata();
			?>
		</div>
	</div>
</div>