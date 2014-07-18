<?php


/*


Template Name: Sitemap


*/


?>


<?php get_header(); ?>





	<!-- page content -->


    <div class="row">


	


		<div class="eight columns">


			<!--breabcrumbs-->


			<?php


				if( $data['rsclean_enable_pagebreadcrumb'] )


					include( BREADCRUMBS );


			?>


			


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


				


	        	<div class="entry sitemap-wrapper">


					<?php if (have_posts()) : the_post(); ?>


						<?php the_content(); ?>


		            <?php endif; ?>


					


					<?php get_template_part('page-templates/sitemap-content'); ?>


	    		</div>





	        </article>   





			<div class="row">


				<div class="twelve columns">


					<div class="edit-post">


						<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>


					</div>


				</div>


			</div>


			


        </div>





        <!--sidebar-->


		<?php get_sidebar(); ?>


		


    </div>


	


<?php get_footer(); ?>


