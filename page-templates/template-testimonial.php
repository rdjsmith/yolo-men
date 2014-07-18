<?php
/*
Template Name: Testimonial
*/

get_header();
global $data;

?>
	

	<div class="pageTop">
		<div class="row">
			<div class="twelve columns">
				<header class="text-center">
					<h2 class="pageTitle"><?php the_title(); ?></h2>
				</header>
			</div>
		</div>
	</div>
	
	<!-- page content -->     
	<div class="row" role="main">
		
		<div class="eight columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<div class="testimonialWrapper">
				<div class="row">
					<?php
						$num_review = $data['rsclean_testimonial_count'];
						$args = array(
							'post_type'			=> 'testimonial',
							'posts_per_page'	=> $num_review
						);
						
						$query = new WP_Query( $args );
						if( $query->have_posts() ) {
							
							while( $query->have_posts() ) : $query->the_post();
								$author_name = get_post_meta( get_the_ID(), '_cmb_author_name', true );
								$author_position = get_post_meta( get_the_ID(), '_cmb_author_position', true );
								$author_company_name = get_post_meta( get_the_ID(), '_cmb_author_company_name', true );
								$author_company_url = get_post_meta( get_the_ID(), '_cmb_author_company_url', true );
								$author_gravatar = get_post_meta( get_the_ID(), '_cmb_author_gravatar', true );
								
								?>
									<div class="twelve columns">
										<div class="testimonial-item">
											<div class="testimonial-body text-center">
												<em class="droid-italic"><?php echo get_the_content(); ?></em>
											</div>
											<div class="row collapse">
												<?php if( $author_gravatar ) { ?>
													<div class="two columns">
														<div class="testimonial-avatar">
															<img src="<?php echo $author_gravatar; ?>" alt="<?php echo esc_attr( $author_name ); ?>" />
														</div>
													</div>
												<?php } ?>
												
												<div class="<?php echo isset( $author_gravatar ) ? 'ten' : 'twelve' ?> columns">
													<div class="testimonial-author">
														<p>
															<strong><?php echo $author_name; ?></strong> <br/>
															<?php echo $author_position; ?> <br/>
															
															<?php if( $author_company_url ) { ?>
																<a href="<?php echo esc_url( $author_company_url ); ?>"><?php echo $author_company_name; ?></a>
															<?php } else { ?>
																<?php echo $author_company_name; ?>
															<?php } ?>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
							endwhile;
							
						} else { ?>
							<div class="twelve columns">
								<h2>No content found</h2>
								<p>Sorry but we don't have enough testimonial yet to dipslay at the moment.</p>
							</div>
						<?php
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="twelve columns">
					<div class="edit-post">
						<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>
					</div>
				</div>
			</div>
		
		</div>
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>