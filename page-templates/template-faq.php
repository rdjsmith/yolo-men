<?php
/*
Template Name: FAQ
*/

get_header();
the_post();

global $data; ?>

	<!-- page content -->     
	<div class="row">
		
		<div class="eight columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="page-title"><?php the_title(); ?></h2>
				
				<div class="entry">	
					<?php the_content(); ?>
				</div>
			</article>
			
			<!--slider wrapper-->
			<div class="slider-wrapper">
				<div class="row">
					<?php
						$args = array(
							'post_type'			=> 'faq',
							'posts_per_page'	=> -1
						);
						
						$query = new WP_Query( $args );
						if( $query->have_posts() )
						{
							?>
							<div class="twelve columns">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<ul class="rs-toggle-box no-bullet">
										<div class="entry">
											<?php
												while( $query->have_posts() ) : $query->the_post();
													?>
														<li class='rs-divider'>
															<h2 class='toggle-box-title'><?php the_title(); ?></h2>
															<div class='toggle-box-content'><br />
																<?php the_content(); ?>
															</div>
														</li>
													<?php
												endwhile;
											?>
										</div>
									</ul>
								</article>
							</div>
							<?php

						} else { ?>
							
							<div class="twelve columns">
								<h2>No content found</h2>
								<p>Sorry but we don't have enough faq yet to dipslay at the moment.</p>
							</div>
							
							<?php
						}
					?>
				</div>
			</div>
		
		</div>
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
	</div>

	<!--comment form-->
	<?php
		if( $data['rsclean_enable_pagecomment'] )
			comments_template( '', true );
	?>

	<div class="row">
		<div class="twelve columns">
			<div class="edit-post">
				<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>