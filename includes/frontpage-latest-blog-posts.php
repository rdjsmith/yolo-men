<div class="row">
	<?php
		$args = array(
			'posts_per_page' => '2',
		);
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) { $the_query->the_post();
				?>
					<div class="six columns">
						<div class="blogItem">	
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="row">
									<div class="six mobile-two columns">
										<div class="textCenter">
											<div class="blogMediaWrapper">
												<figure>
													<?php
														$attr = array(
															'class'	=> "blog-attachment-media",
															'alt'	=> trim(strip_tags( get_the_title() )),
															'title'	=> trim(strip_tags( get_the_title() ))
														);
														echo '<a href="'. esc_url( get_permalink( get_the_ID() ) ) .'" data-rel="fancybox">' . get_the_post_thumbnail( get_the_ID(), 'full', $attr ) . '</a>';
													?>
												</figure>
											</div>
										</div>
									</div>
									<div class="six mobile-two columns">
										<h3 class="blogTitle mt0"><?php the_title(); ?></h3>
										
										<div class="entry">
											<?php echo wpautop( rs_truncate( get_the_excerpt(), 200 ) ); ?>
										</div>
										
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="readMore">READ MORE &rsaquo;</a>
									</div>
								</div>
							</div>
						</article>
					</div>
				<?php
			}
		} else {
			// no posts found
		}
		
		/* Restore original Post Data */
		wp_reset_postdata();
	?>
</div>