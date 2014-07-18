<?php
	
// Hook in
add_filter( 'woocommerce_billing_fields', 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
	$fields['billing_inches_centimeters'] = array(
		'options' => array(
			'cm' 		=> 'Centimeters',
			'inches' 	=> 'Inches'
		),
		'required'  => false,
		'class'     => array('form-row-wide'),
		'clear'     => false,
		'type'		=> 'select'
	);
	
	$fields['billing_standard_measurement'] = array(
		'label'     	=> __('Standard Measurement', 'woocommerce'),
		'placeholder'   => _x('Standard Measurement', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
    );
	
	$fields['billing_neck_circumference'] = array(
		'label'     	=> __('Neck Circumference', 'woocommerce'),
		'placeholder'   => _x('Neck Circumference', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true
    );
	
	$fields['billing_chest'] = array(
		'label'     	=> __('Chest', 'woocommerce'),
		'placeholder'   => _x('Chest', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
    );
	
	$fields['billing_stomach_circumference'] = array(
		'label'     	=> __('Stomach Circumference', 'woocommerce'),
		'placeholder'   => _x('Stomach Circumference', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true
    );
	
	$fields['billing_jacket_length'] = array(
		'label'     	=> __('Jacket Length', 'woocommerce'),
		'placeholder'   => _x('Jacket Length', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
    );

	$fields['billing_shoulder_width'] = array(
		'label'     	=> __('Shoulder Width', 'woocommerce'),
		'placeholder'   => _x('Shoulder Width', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true
    );

	$fields['billing_sleeve_length'] = array(
		'label'     	=> __('Sleeve Length', 'woocommerce'),
		'placeholder'   => _x('Sleeve Length', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
    );
	
	$fields['billing_armpit'] = array(
		'label'     	=> __('Armpit', 'woocommerce'),
		'placeholder'   => _x('Armpit', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true
    );
	
	$fields['billing_bicep'] = array(
		'label'     	=> __('Bicep', 'woocommerce'),
		'placeholder'   => _x('Bicep', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-first'),
		'clear'     	=> false
    );
	
	$fields['billing_hip_circumference'] = array(
		'label'     	=> __('Hip Circumference', 'woocommerce'),
		'placeholder'   => _x('Hip Circumference', 'placeholder', 'woocommerce'),
		'required'  	=> false,
		'class'     	=> array('form-row-last'),
		'clear'     	=> true
    );
	
    return $fields;
}

?>