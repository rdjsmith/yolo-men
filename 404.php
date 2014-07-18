<?php
/**
 * The Template for displaying 404 page or page not found
 */

get_header(); ?>
	
	<div class="row">
		<div class="twelve columns">
			<!--breabcrumbs-->
			<?php include( BREADCRUMBS ); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h2 class="pageTitle">No content found</h2>
				</header>
				
				<div class="entry">
					<p>Sorry but we can't find the posts you're looking for, perharps searching will help.</p>
					
					<?php get_search_form(); ?>
					
					<h2>Sitemap</h2>
					<div class="sitemap-wrapper">
						<?php get_template_part('page-templates/sitemap-content'); ?>
					</div>
				</div>
			</article>
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>