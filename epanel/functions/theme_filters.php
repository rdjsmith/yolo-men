<?php
/**
 * @desc	If you have something to add in add_filter function add it here.
 * @author	Ryan Sutana
 * @uri		http://www.sutanaryan.com/
 */

/* remove gallery inline css */
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'wp_get_attachment_link', 'rs_add_rel_attribute' );
 
add_filter( 'excerpt_length', 'rs_custom_excerpt_length', 999 );
add_filter( 'excerpt_more', 'rs_new_excerpt_more' );

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove Order Note Field in Billing area
add_filter( 'woocommerce_checkout_fields', 'rs_customize_billing_checkout_fields' );
add_filter( 'woocommerce_states', 'rs_customize_woocommerce_states' );

/**
 * @desc	Filter 
 */
function rs_add_rel_attribute( $link ) {
	global $post;
	
	return str_replace('<a href', '<a data-rel="fancybox" href', $link);
}


/**
 * @desc	Filter custom post to only display 4o words
 */
function rs_custom_excerpt_length( $length ) {
	return 40;
}

/**
 * @desc	Add readmore in category page
 */
function rs_new_excerpt_more( $more ) {
	global $post;
	
	return '... <a href="'. esc_url( get_permalink($post->ID) ) . '" class="blog-continue-reading">Read more &rarr;</a>';
}


/**
 * @desc	Order Checkout Fields
 */
function rs_customize_billing_checkout_fields( $old_fields )
{
	// Change order in Billing Details
	$new_fields['billing']['billing_first_name'] 	= $old_fields['billing']['billing_first_name'];
	$new_fields['billing']['billing_last_name'] 	= $old_fields['billing']['billing_last_name'];
	$new_fields['billing']['billing_company'] 		= $old_fields['billing']['billing_company'];
	$new_fields['billing']['billing_address_1'] 	= $old_fields['billing']['billing_address_1'];
	$new_fields['billing']['billing_address_2'] 	= $old_fields['billing']['billing_address_2'];
	$new_fields['billing']['billing_city'] 			= $old_fields['billing']['billing_city'];
	$new_fields['billing']['billing_country'] 		= $old_fields['billing']['billing_country'];
	$new_fields['billing']['billing_state'] 		= $old_fields['billing']['billing_state'];
	$new_fields['billing']['billing_postcode'] 		= $old_fields['billing']['billing_postcode'];
	$new_fields['billing']['billing_email'] 		= $old_fields['billing']['billing_email'];
	$new_fields['billing']['billing_phone'] 		= $old_fields['billing']['billing_phone'];
	
	// billing custom fields
	$new_fields['billing']['billing_inches_centimeters'] 	= $old_fields['billing']['billing_inches_centimeters'];
	$new_fields['billing']['billing_standard_measurement'] 	= $old_fields['billing']['billing_standard_measurement'];
	$new_fields['billing']['billing_neck_circumference'] 	= $old_fields['billing']['billing_neck_circumference'];
	$new_fields['billing']['billing_chest'] 				= $old_fields['billing']['billing_chest'];
	$new_fields['billing']['billing_stomach_circumference'] = $old_fields['billing']['billing_stomach_circumference'];
	$new_fields['billing']['billing_jacket_length'] 		= $old_fields['billing']['billing_jacket_length'];
	$new_fields['billing']['billing_shoulder_width'] 		= $old_fields['billing']['billing_shoulder_width'];
	$new_fields['billing']['billing_sleeve_length'] 		= $old_fields['billing']['billing_sleeve_length'];
	$new_fields['billing']['billing_armpit'] 				= $old_fields['billing']['billing_armpit'];
	$new_fields['billing']['billing_bicep'] 				= $old_fields['billing']['billing_bicep'];
	$new_fields['billing']['billing_hip_circumference'] 	= $old_fields['billing']['billing_hip_circumference'];
    
	// update billing company class
	$new_fields['shipping']['billing_company']['class'] = 'form-row-wide';
	
	$new_fields['shipping'] 	= $old_fields['shipping'];
	$new_fields['account'] 		= $old_fields['account'];
	$new_fields['order'] 		= $old_fields['order'];
	
	// unset order comment fields
	unset( $new_fields['order']['order_comments'] );
	
	
	return $new_fields;
}


// Hook in
add_filter( 'woocommerce_default_address_fields' , 'rs_custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function rs_custom_override_checkout_fields( $fields ) {
	$fields['address_2']['placeholder'] = 'Unfortunately we are unable to ship goods to a PO Box address - residential or business address only please';
	
	return $fields;
}


/**
 * @desc	Customized State name to abbreviation
 */
function rs_customize_woocommerce_states() {
	global $states;
	
	$states['AU'] = array(
		'ACT' => __( 'ACT', 'woocommerce' ),
		'NSW' => __( 'NSW', 'woocommerce' ),
		'NT'  => __( 'NT', 'woocommerce' ),
		'QLD' => __( 'QLD', 'woocommerce' ),
		'SA'  => __( 'SA', 'woocommerce' ),
		'TAS' => __( 'TAS', 'woocommerce' ),
		'VIC' => __( 'VIC', 'woocommerce' ),
		'WA'  => __( 'WA', 'woocommerce' )
	);
	
	$states['US'] = array(
		'AL' => __( 'AL', 'woocommerce' ),
		'AK' => __( 'AK', 'woocommerce' ),
		'AZ' => __( 'AZ', 'woocommerce' ),
		'AR' => __( 'AR', 'woocommerce' ),
		'CA' => __( 'CA', 'woocommerce' ),
		'CO' => __( 'CO', 'woocommerce' ),
		'CT' => __( 'CT', 'woocommerce' ),
		'DE' => __( 'DE', 'woocommerce' ),
		'DC' => __( 'DC', 'woocommerce' ),
		'FL' => __( 'FL', 'woocommerce' ),
		'GA' => __( 'GA', 'woocommerce' ),
		'HI' => __( 'HI', 'woocommerce' ),
		'ID' => __( 'ID', 'woocommerce' ),
		'IL' => __( 'IL', 'woocommerce' ),
		'IN' => __( 'IN', 'woocommerce' ),
		'IA' => __( 'IA', 'woocommerce' ),
		'KS' => __( 'KS', 'woocommerce' ),
		'KY' => __( 'KY', 'woocommerce' ),
		'LA' => __( 'LA', 'woocommerce' ),
		'ME' => __( 'ME', 'woocommerce' ),
		'MD' => __( 'MD', 'woocommerce' ),
		'MA' => __( 'MA', 'woocommerce' ),
		'MI' => __( 'MI', 'woocommerce' ),
		'MN' => __( 'MN', 'woocommerce' ),
		'MS' => __( 'MS', 'woocommerce' ),
		'MO' => __( 'MO', 'woocommerce' ),
		'MT' => __( 'MT', 'woocommerce' ),
		'NE' => __( 'NE', 'woocommerce' ),
		'NV' => __( 'NV', 'woocommerce' ),
		'NH' => __( 'NH', 'woocommerce' ),
		'NJ' => __( 'NJ', 'woocommerce' ),
		'NM' => __( 'NM', 'woocommerce' ),
		'NY' => __( 'NY', 'woocommerce' ),
		'NC' => __( 'NC', 'woocommerce' ),
		'ND' => __( 'ND', 'woocommerce' ),
		'OH' => __( 'OH', 'woocommerce' ),
		'OK' => __( 'OK', 'woocommerce' ),
		'OR' => __( 'OR', 'woocommerce' ),
		'PA' => __( 'PA', 'woocommerce' ),
		'RI' => __( 'RI', 'woocommerce' ),
		'SC' => __( 'SC', 'woocommerce' ),
		'SD' => __( 'SD', 'woocommerce' ),
		'TN' => __( 'TN', 'woocommerce' ),
		'TX' => __( 'TX', 'woocommerce' ),
		'UT' => __( 'UT', 'woocommerce' ),
		'VT' => __( 'VT', 'woocommerce' ),
		'VA' => __( 'VA', 'woocommerce' ),
		'WA' => __( 'WA', 'woocommerce' ),
		'WV' => __( 'WV', 'woocommerce' ),
		'WI' => __( 'WI', 'woocommerce' ),
		'WY' => __( 'WY', 'woocommerce' ),
		'AA' => __( 'AA', 'woocommerce' ),
		'AE' => __( 'AE', 'woocommerce' ),
		'AP' => __( 'AP', 'woocommerce' ),
		'AS' => __( 'AS', 'woocommerce' ),
		'GU' => __( 'GU', 'woocommerce' ),
		'MP' => __( 'MP', 'woocommerce' ),
		'PR' => __( 'PR', 'woocommerce' ),
		'UM' => __( 'UM', 'woocommerce' ),
		'VI' => __( 'VI', 'woocommerce' ),
	);

	return $states;
}
