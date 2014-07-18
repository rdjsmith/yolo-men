<?php
/*
Template Name: Resources
*/

get_header(); ?>

	<div class="row">
		<div class="twelve columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<?php if( have_posts() ) { ?>
				<?php while( have_posts() ) { the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry">
							<?php the_content(); ?>
						</div>
					</article>
					
				<?php } ?>
			<?php } ?>
			
			<section class="resourcesWrapper">
				<div class="row">
					<?php
						
						$args = array(
							'post_type' 		=> 'resources',
							'posts_per_page'	=> 10
						);
						
						query_posts( $args );
						
						if( have_posts() ) {
							
							while( have_posts() ) { the_post();
								
								?>
									<div class="four columns">
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<h2 class="pageTitle">
												<?php the_title(); ?>
											</h2>
											
											<div class="entry">
												<?php the_content(); ?>
											</div>
											
											<div class="blogMediaWrapper">
												<figure>
													<?php
														$resources_link = get_post_meta( get_the_ID(), '_cmb_resources_link', true );
														
														$attr = array(
															'class'	=> "blog-attachment-media",
															'alt'	=> trim(strip_tags( get_the_title() )),
															'title'	=> 'Download ' . trim(strip_tags( get_the_title() )) . ' Resources'
														);
														echo '<a href="'. esc_url( $resources_link ) .'" target="_blank">' . get_the_post_thumbnail( get_the_ID(), 'full', $attr ) . '</a>';
													?>
												</figure>
											</div>
										</article>
									</div>
								<?php
								
							}
							
							// reset query
							wp_reset_query();
							
						} else {
							_e( 'No resources added yet!', THEME_DOMAIN );
						}
						
					?>
				</div>
			</section>
			
		</div>
	</div>

<?php get_footer(); ?>