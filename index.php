<?php 
/**
 * The main template file.
 *
 *
 * @package WordPress
 * @subpackage RS Responsive
 */
 
get_header(); ?>

	<!-- content -->        	
	<div class="row" role="main">
	
		<div class="twelve columns">
			<?php get_template_part( 'loop' ); ?>
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>