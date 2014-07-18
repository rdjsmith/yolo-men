<?php 
/**
 * @desc	If you have something to add in add_action function add it here.
 * @author	Ryan Sutana
 * @uri		http://www.sutanaryan.com/
 */

add_action( 'wp_head', 'rs_wp_head_hook' );
add_action( 'login_head', 'rs_custom_admin_logo' );

add_action( 'admin_init', 'editor_admin_init' );


/**
 * @desc	Add sf-menu script
 */
function rs_wp_head_hook()
{ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			// superFish
			$('ul.sf-menu').supersubs({
				minWidth:    14, 	// minimum width of sub-menus in em units
				maxWidth:    40, 	// maximum width of sub-menus in em units
				extraWidth:  1 		// extra width can ensure lines don't sometimes turn over
			})
			.superfish({
				delay: 100,
				speed: 'fast'
			});
		});
	</script>
	<?php 
}

function rs_custom_admin_logo() 
{
	global $data;
	
	$logo_path = $data['rsclean_logo'];
	?>
	<style type="text/css">
		body{ background: #121212 }
		.login h1 a{
			background: url('<?php echo $logo_path; ?>') top center no-repeat;
			width: 326px;
			height: 100px;
		}
	</style>
	<?php 
}


function editor_admin_init()
{
	wp_enqueue_script( 
		array( 
			'jquery', 
			'word-count', 
			'post', 
			'editor', 
			'thickbox', 
			'media-upload'
		)
	);
}


/* Single Product
================================================== */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


/* Shop / Category
================================================== */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );



/* WC theme compatibility
================================================== */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'rs_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'rs_theme_wrapper_end', 10 );

function rs_theme_wrapper_start() {
	echo '
		<div class="row">
			<div class="twelve columns">
	';
}

function rs_theme_wrapper_end() {
	echo '
			</div>
		</div>
	';
}

/* Remove Sidebar
================================================== */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


/* WooCommerce Email
================================================== */
woocommerce_order_status_completed