<?php

require_once (TEMPLATEPATH . '/epanel/init.php');
$theme = new WPTheme();
$theme->start(array('theme' => 'RS Responsive', 'slug' => 'rs-responsive', 'version' => '1.0'));

// Custom WP login css
//function the_url( $url ) {
//    return get_bloginfo( 'http://localhost/yolomen/wp-content/images' );
//}
//add_filter( 'login_headerurl', 'the_url' );

// Changes link destination of 'Continue Shopping' button on cart page
add_filter( 'woocommerce_continue_shopping_redirect', 'my_custom_continue_redirect' );
function my_custom_continue_redirect( $url ) {
    $homebaseurl = home_url()  . '/shop';
return $homebaseurl;
}

/** woocommerce: change position of add-to-cart on single product **/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

/** Remove ordering dropdown **/
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 30 );

?>