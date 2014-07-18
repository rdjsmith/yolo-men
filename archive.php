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
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_postbreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<div class="row">
				<header>
					<h2 class="pageTitle"><?php the_time('F, Y'); ?></h2>
					<p>Posts Made In <?php the_time('F, Y'); ?></p>
				</header>
				
				<?php get_template_part( 'loop' ); ?>
			</div>
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>