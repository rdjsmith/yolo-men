<?php
/**
 * The Template for displaying all page posts.
 */

get_header(); ?>

	<div class="row">
		<div class="twelve columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<?php if ( have_posts() ) : ?>
				
				<?php woocommerce_content(); ?>
			
			<?php endif; ?>
			
			<!--comment form-->
			<?php
				if( $data['rsclean_enable_pagecomment'] )
					comments_template( '', true );
			?>
		</div>
	</div>

<?php get_footer(); ?>