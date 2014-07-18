<div class="row">
	<?php
		global $data;
		
		for( $i = 1; $i <= 4; $i++ ) {
			$args = array(
				'post_type'			=> 'product',
				'page_id'			=> $data['rsclean_collection_' . $i]
			);
			
			$the_query = new WP_Query( $args );
			
			// The Loop
			if ( $the_query->have_posts() ) {
				
				while ( $the_query->have_posts() ) { $the_query->the_post();
					?>
						<div class="three mobile-two columns">
							<div class="blogMediaWrapper">
								<figure>
									<?php
										$attr = array(
											'class'	=> "blog-attachment-media",
											'alt'	=> trim(strip_tags( get_the_title() )),
											'title'	=> trim(strip_tags( get_the_title() ))
										);
										echo '<a href="'. get_permalink() .'">' . get_the_post_thumbnail( get_the_ID(), 'full', $attr ) . '</a>';
									?>
								</figure>
							</div>
						</div>
					<?php
				}
			} else {
				// no posts found
			}
			
			/* Restore original Post Data */
			wp_reset_postdata();
		}
	?>
</div>