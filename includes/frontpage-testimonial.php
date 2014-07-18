<div class="row">
	<?php
		$args = array(
			'post_type'		=> 'testimonial',
			'post_status'	=> 'publish',
			'order'			=> 'ASC',
			'orderby'		=> 'rand'
		);
		
		// initialize new query
		$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) {
			
			while ( $the_query->have_posts() ) { $the_query->the_post();
				$author_name = get_post_meta( get_the_ID(), '_cmb_author_name', true );
				$author_position = get_post_meta( get_the_ID(), '_cmb_author_position', true );
				$author_company_name = get_post_meta( get_the_ID(), '_cmb_author_company_name', true );
				$author_company_url = get_post_meta( get_the_ID(), '_cmb_author_company_url', true );
				$author_gravatar = get_post_meta( get_the_ID(), '_cmb_author_gravatar', true );
				?>
					<div class="four columns">
						<div class="testimonialitem">
							<div class="testimonialContent">
								<p>
									<span class="sup left">&nbsp;</span>
										<?php echo get_the_content(); ?>
									<span class="sub right">&nbsp;</span>
								</p>
							</div>
							<div class="testimonialInfo">
								<div class="textRight">
									<span class="testimonialAuthor">- <?php echo $author_name; ?></span>
								</div>
							</div>
						</div>
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