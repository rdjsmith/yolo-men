<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			
			<?php if( is_shop() ) { ?>
			
				<div class="productsLists">
					<?php woocommerce_product_subcategories(); ?>
				
					<?php
						// no default values. using these as examples
						$taxonomies = array( 
							'product_cat'
						);

						$args = array(
							'orderby'       => 'name', 
							'order'         => 'DESC',
							'parent'      	=> 19		// manually display parent category
						);
						$terms = get_terms( $taxonomies, $args );
						
						foreach ( $terms as $term )
						{
							woocommerce_product_loop_start();
							
							echo '<li><h3>' . $term->name . '</h3></li>';
							
							$args = array(
								'post_type' => 'product',
								'product_cat'		=> $term->slug,
								'posts_per_page'	=> get_option( 'posts_per_page' )
							);
							
							// The Query
							$loop = new WP_Query( $args );
							
							if ( $loop->have_posts() ) {
								
								while ( $loop->have_posts() ) : $loop->the_post();
									woocommerce_get_template_part( 'content', 'product' );
								endwhile;
							
							} else {
								echo __( 'No products found' );
							}
							
							/* Restore original Post Data 
							 * NB: Because we are using new WP_Query we aren't stomping on the 
							 * original $wp_query and it does not need to be reset.
							*/
							wp_reset_postdata();
							
							woocommerce_product_loop_end();
						}
					?>
				</div>
				
			<?php } else { ?>
			
				<div class="productsLists">
					<?php woocommerce_product_loop_start(); ?>
					<?php woocommerce_product_subcategories(); ?>
					
						<?php
							while ( have_posts() ) : the_post();
								woocommerce_get_template_part( 'content', 'product' );
							endwhile;
						?>
						
					<?php woocommerce_product_loop_end(); ?>
				</div>
				
			<?php } ?>
			
			<div class="featureImageFrameWrapper">
				<div class="featureImageFrame" id="featureImageFrame">
					<p>Hover the product on the left hand side to view the full product image in this area.</p>
				</div>
			</div>
			<div class="clear"></div>
			
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>