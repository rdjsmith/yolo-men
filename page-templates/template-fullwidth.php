<?php


/*


Template Name: Full Width


*/


?>





<?php get_header(); ?>





	<!--content-->


    <div class="row">


		<div class="twelve columns">


			<!--breabcrumbs-->


			<?php


				if( $data['rsclean_enable_pagebreadcrumb'] )


					include( BREADCRUMBS );


			?>


			


            <?php if (have_posts()) : ?>


				


				<?php while (have_posts()) : the_post(); ?>


					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


						<h2><?php the_title(); ?></h2>


						


						<div class="entry">


							<?php the_content(); ?>


						</div>


					</article>


				<?php endwhile; ?>


			


			<?php else: ?>


			


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>


                </article>


				


            <?php endif; ?>  


        


			<div class="row">


				<div class="twelve columns">


					<div class="edit-post">


						<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>


					</div>


				</div>


			</div>


		


		</div>


    </div>





<?php get_footer(); ?>