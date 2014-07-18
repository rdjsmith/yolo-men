<?php 
/**
 * The main template file.
 *
 *
 * @package WordPress
 * @subpackage rsclean
 */
 
get_header(); ?>

	<div class="row">
		<div class="twelve columns">
			<header>
				<h2 class="pageTitle">Category: <?php single_cat_title(); ?></h2>
			</header>
			
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_postbreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<div class="row">
				<?php get_template_part( 'loop' ); ?>
			</div>
		</div>
		
		<!--sidebar-->
	</div>
	
<?php get_footer(); ?>