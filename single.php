<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>
	
	<div class="row">
		<div class="twelve columns">
			
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_postbreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<?php while(have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2 class="entryTitle"><?php the_title(); ?></h2>
					</header>
					
					<?php
						if( $data['rsclean_enable_postmeta'] )
							include( POST_INFO );
					?>
					
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</article>
				
			<?php endwhile; ?>
			
			<section class="row">
				<div class="six columns text-left">
					<?php previous_post_link('%link', '&larr; %title', FALSE); ?>
				</div>
				<div class="six columns text-right">
					<?php next_post_link('%link', '%title &rarr;', FALSE); ?>
				</div> 
				<div class="clear"></div>
			</section>
			
			<section class="tagWrapper">
				<div class="row">
					<div class="twelve columns">
						<?php the_tags('<span class="tag">Tags:</span> ', ', ', ''); ?>
					</div>
				</div>
			</section>
			
			<!--comment form-->
			<?php
				if( $data['rsclean_enable_postcomment'] )
					comments_template( '', true );
			?>
			
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>