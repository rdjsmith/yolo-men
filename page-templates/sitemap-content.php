<div class="row">


	<div class="six columns">


		<div class="sitemap-pages">												  


			<h3><?php _e('Pages', RS_DOMAIN) ?></h3>


			<ul>


				<?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>		


			</ul>


		</div>				





		<div class="sitemap-categories">												  	    


			<h3><?php _e('Categories', RS_DOMAIN) ?></h3>


			<ul>


				<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	


			</ul>


		</div>


	</div>


	


	<div class="six columns">


		<h3><?php _e('Posts per category', RS_DOMAIN); ?></h3>


		<?php


			$cats = get_categories();


			foreach ($cats as $cat) 


			{


				query_posts('cat='.$cat->cat_ID); ?>





				<h4><?php echo $cat->cat_name; ?></h4>


				<ul>	


					<?php while (have_posts()) : the_post(); ?>


					<li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes') ?> (<?php echo $post->comment_count ?>)</li>


					<?php endwhile;  ?>


				</ul><?php 


			}


		?>


	</div>


</div>