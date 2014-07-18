<?php
/*
Template Name: Default
*/
?>
<?php
get_header(); ?>

	<div class="row">
		<div class="twelve columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<?php while(have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2 class="pageTitle"><?php the_title(); ?></h2>
					</header>
					
					<?php
						if( $data['rsclean_enable_pagemeta'] )
							include( POST_INFO );
					?>
					
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</article>
			
			<?php endwhile; ?>
				
			<!--comment form-->
			<?php
				if( $data['rsclean_enable_pagecomment'] )
					comments_template( '', true );
			?>
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>