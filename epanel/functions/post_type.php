<?php
/*
 * @desc Register new post type
 * @author Ryan Sutana
 */	

add_action( 'init', 'register_posts_types' );
/*
 * @desc	Regsiter product post_types for testimonial
 */
function register_posts_types() {
	global $theme_domain;

	// Testimonial
	$args = array(
		'label'                         => __( 'Testimonial Categories', $theme_domain ),
		'labels'                        => array(
			'name'                          => __( 'Testimonial Categories', $theme_domain ),
			'singular_name'                 => __( 'Testimonial Category', $theme_domain ),
			'search_items'                  => __( 'Search Testimonial Category', $theme_domain ),
			'popular_items'                 => __( 'Popular Testimonial Categories', $theme_domain ),
			'all_items'                     => __( 'All Testimonial Categories', $theme_domain ),
			'parent_item'                   => __( 'Parent Testimonial Category', $theme_domain ),
			'edit_item'                     => __( 'Edit Testimonial Category', $theme_domain ),
			'update_item'                   => __( 'Update Testimonial Category', $theme_domain ),
			'add_new_item'                  => __( 'Add New Testimonial Category', $theme_domain ),
			'new_item_name'                 => __( 'New Testimonial Category', $theme_domain ),
			'separate_items_with_commas'    => __( 'Separate categories with commas', $theme_domain ),
			'add_or_remove_items'           => __( 'Add or remove categories', $theme_domain ),
			'choose_from_most_used'         => __( 'Choose from most used categories', $theme_domain )
		),
		'public'                        => true,
		'show_ui'                		=> true,
		'show_admin_column'       		=> true,
		'show_in_nav_menus'             => true,
		'hierarchical'                  => true,
		'update_count_callback' 		=> '_update_post_term_count',
		'rewrite' 						=> array(
			'slug' 							=> 'testimonial-category',
			'hierarchical' 					=> true,
		),
		'query_var'                     => true
	);
	register_taxonomy( 'testimonial-category', 'testimonial', $args );


	// register posttype for our testimonial
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name' 					=> __( 'Testimonial' ),
				'singular_name' 		=> __( 'Testimonial' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Testimonial' ),
				'edit_item' 			=> __( 'Edit Testimonial' ),
				'new_item' 				=> __( 'Add New Testimonial' ),
				'view_item' 			=> __( 'View Testimonial' ),
				'search_items' 			=> __( 'Search Testimonial' ),
				'not_found' 			=> __( 'No testimonial found' ),
				'not_found_in_trash' 	=> __( 'No testimonial found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "testimonial" ),
			'menu_position' 		=> 82,
			'menu_icon' 			=> get_template_directory_uri() . '/images/icons/testimonial-icon.png'
		)
	);
	
	
	// Resources page
	register_post_type( 'resources',
		array(
			'labels' => array(
				'name' 					=> __( 'Resources' ),
				'singular_name' 		=> __( 'Resources' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Resources' ),
				'edit_item' 			=> __( 'Edit Resources' ),
				'new_item' 				=> __( 'Add New Resources' ),
				'view_item' 			=> __( 'View Resources' ),
				'search_items' 			=> __( 'Search Resources' ),
				'not_found' 			=> __( 'No resources found' ),
				'not_found_in_trash' 	=> __( 'No resources found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'thumbnail', 'editor' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "resources" ),
			'menu_position' 		=> 82,
			'menu_icon' 			=> get_template_directory_uri() . '/images/icons/resources-icon.png'
		)
	);
	
	
	/*
	// Portfolio
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' 					=> __( 'Portfolio' ),
				'singular_name' 		=> __( 'Portfolio' ),
				'add_new' 				=> __( 'Add New' ),
				'add_new_item' 			=> __( 'Add New Portfolio' ),
				'edit_item' 			=> __( 'Edit Portfolio' ),
				'new_item' 				=> __( 'Add New Portfolio' ),
				'view_item' 			=> __( 'View Portfolio' ),
				'search_items' 			=> __( 'Search Portfolio' ),
				'not_found' 			=> __( 'No portfolio found' ),
				'not_found_in_trash' 	=> __( 'No portfolio found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title', 'thumbnail', 'editor' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "portfolio" ),
			'menu_position' 		=> 82,
			'menu_icon' 			=> get_template_directory_uri() . '/images/icons/portfolio-icon.png'
		)
	);
	
	// Portfolio Category
	$args = array(
		'label'                         => __( 'Portfolio Categories', $theme_domain ),
		'labels'                        => array(
			'name'                          => __( 'Portfolio Categories', $theme_domain ),
			'singular_name'                 => __( 'Portfolio Category', $theme_domain ),
			'search_items'                  => __( 'Search Portfolio Category', $theme_domain ),
			'popular_items'                 => __( 'Popular Portfolio Categories', $theme_domain ),
			'all_items'                     => __( 'All Portfolio Categories', $theme_domain ),
			'parent_item'                   => __( 'Parent Portfolio Category', $theme_domain ),
			'edit_item'                     => __( 'Edit Portfolio Category', $theme_domain ),
			'update_item'                   => __( 'Update Portfolio Category', $theme_domain ),
			'add_new_item'                  => __( 'Add New Portfolio Category', $theme_domain ),
			'new_item_name'                 => __( 'New Portfolio Category', $theme_domain ),
			'separate_items_with_commas'    => __( 'Separate categories with commas', $theme_domain ),
			'add_or_remove_items'           => __( 'Add or remove categories', $theme_domain ),
			'choose_from_most_used'         => __( 'Choose from most used categories', $theme_domain )
		),
		'public'                        => true,
		'show_ui'                		=> true,
		'show_admin_column'       		=> true,
		'show_in_nav_menus'             => true,
		'hierarchical'                  => true,
		'update_count_callback' 		=> '_update_post_term_count',
		'rewrite' 						=> array(
			'slug' 							=> 'portfolio-category',
			'hierarchical' 					=> true,
		),
		'query_var'                     => true
	);
	register_taxonomy( 'portfolio-category', 'portfolio', $args );
	*/
}