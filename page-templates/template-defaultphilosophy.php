<?php
/*
Template Name: Default + Philosophy Page
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
				
                                <section class="philoshophyWrapper">
                                        <div class="row">
                                                <div class="twelve column">
                                                                <h2 class="pageTitle philosophyTitle"><?php echo empty( $data['rsclean_philosophy_title'] ) ? 'Philosophy' : $data['rsclean_philosophy_title']; ?></h2>
                                                </div>
                                                <div class="twelve column">
                                                        <?php echo wpautop( $data['rsclean_philosophy_description'] ); ?>
                                                </div>
                                        </div>
                                </section>

			<!--comment form-->
			<?php
				if( $data['rsclean_enable_pagecomment'] )
					comments_template( '', true );
			?>
		</div>
		
		<!--sidebar-->
	</div>

<?php get_footer(); ?>