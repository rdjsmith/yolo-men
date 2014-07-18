<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes['testimonial_metabox'] = array(
		'id'         => 'testimonial-meta',
		'title'      => __( 'Testimonial Author Meta', 'cmb' ),
		'pages'      => array( 'testimonial'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Author', 'cmb' ),
				'desc' => __( 'Author name who wrote this testimonial.', 'cmb' ),
				'id'   => $prefix . 'author_name',
				'type' => 'text'
			),
			array(
				'name' => __( 'Position', 'cmb' ),
				'desc' => __( 'Author position.', 'cmb' ),
				'id'   => $prefix . 'author_position',
				'type' => 'text'
			),
			array(
				'name' => __( 'Company Name', 'cmb' ),
				'desc' => __( 'Author company name.', 'cmb' ),
				'id'   => $prefix . 'author_company_name',
				'type' => 'text'
			),
			array(
				'name' => __( 'Company URL', 'cmb' ),
				'desc' => __( 'Author company url.', 'cmb' ),
				'id'   => $prefix . 'author_company_url',
				'type' => 'text_url'
			),
			array(
				'name' => __( 'Author Avatar', 'cmb' ),
				'desc' => __( 'Author company url.', 'cmb' ),
				'id'   => $prefix . 'author_gravatar',
				'type' => 'text_url'
			)
		),
	);
	
	
	$meta_boxes['resources_metabox'] = array(
		'id'         => 'resources-meta',
		'title'      => __( 'Resources Meta', 'cmb' ),
		'pages'      => array( 'resources'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Resources Link', 'cmb' ),
				'desc' => __( 'Add resources link here.', 'cmb' ),
				'id'   => $prefix . 'resources_link',
				'type' => 'text'
			)
		),
	);
	
	return $meta_boxes;
}


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once THEME_DIR.'/lib/metabox/meta/init.php';

}
