<?php

class WPThemeAddons extends WPTheme{

	function theme_init() 
	{
		remove_action( 'wp_head', 'wp_generator' ); 					// remove generator meta
		add_filter( 'the_content_more_link', 'remove_more_jump_link' ); // remove more-link jumper
		add_filter( 'wp_nav_menu', 'do_shortcode' );
		add_filter( 'widget_text', 'do_shortcode' );					// enable shortcode in widget
		add_filter( 'show_admin_bar', '__return_false' );				// disable admin bar on front-end

		add_action( 'init', array(&$this, 'init'));						// initialize theme styles and scripts
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_theme_styles_scripts') );
		add_action( 'after_setup_theme', array(&$this, 'rs_theme_setup') );
	}
	
	function rs_theme_setup() {
		// load theme languages
		load_theme_textdomain( THEME_DOMAIN, get_template_directory() . '/languages' );
	}
	
	function init()
	{		
		// localize wp-ajax
		wp_enqueue_script( 'rsclean-request-script', get_stylesheet_directory_uri() . '/js/theme-ajax.js', array( 'jquery' ) );
		wp_localize_script( 'rsclean-request-script', 'theme_ajax', array(
			'url'		=> admin_url( 'admin-ajax.php' ),
			'site_url' 	=> get_bloginfo('url'),
			'theme_url' => get_bloginfo('template_directory')
		) );

		// register scripts and styles
		wp_register_script( 'rs-modernizr_scripts', get_stylesheet_directory_uri() . '/js/modernizr.foundation.js', array('jquery'), '1.0', true );
		wp_register_script( 'rs-superfish_script', get_stylesheet_directory_uri() . '/js/superfish.js', array('jquery'), '1.4.8', true );
		wp_register_script( 'rs-supersubs_script', get_stylesheet_directory_uri() . '/js/supersubs.js', array('jquery'), '0.2b', true );
		wp_register_script( 'rs-slides_script', get_stylesheet_directory_uri() . '/js/responsiveslides.min.js', array('jquery'), '1.51', true );
		
		wp_register_script( 'rs-fancybox_script', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), '1.51', true );
		wp_register_script( 'rs-fancybox_media_script', get_stylesheet_directory_uri() . '/js/jquery.fancybox-media.js', array('jquery'), '1.51', true );
		wp_register_script( 'rs-placeholder_script', get_stylesheet_directory_uri() . '/js/jquery.placeholder.min.js', array('jquery'), '2.0.7', true );
		wp_register_script( 'rs-cycle_script', get_stylesheet_directory_uri() . '/js/jquery.cycle.all.js', array('jquery'), '2.0.7', true );
		
		wp_register_script( 'rs-storelocator_script', get_stylesheet_directory_uri() . '/js/jquery.storelocator.js', array('jquery'), '1.3.3', true );
		wp_register_script( 'rs-geocode_script', get_stylesheet_directory_uri() . '/js/geocode.js', array('jquery'), '1.0.0', true );
		
		wp_register_script( 'rs-theme_scripts', get_stylesheet_directory_uri() . '/js/rs-scripts.js', array('jquery'), '1.0', true );
		
		wp_register_style( 'rs-font_awesome_style', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', false, '1.51', 'all' );
		wp_register_style( 'rs-font_awesome-corp_style', get_stylesheet_directory_uri() . '/css/font-awesome-corp.css', false, '1.51', 'all' );
		wp_register_style( 'rs-font_awesome-extstyle', get_stylesheet_directory_uri() . '/css/font-awesome-ext.css', false, '1.51', 'all' );
		wp_register_style( 'rs-font_awesome-social_style', get_stylesheet_directory_uri() . '/css/font-awesome-social.css', false, '1.51', 'all' );
		wp_register_style( 'rs-responsive_style', get_stylesheet_directory_uri() . '/css/layout-responsive.css', false, '1.51', 'all' );
		wp_register_style( 'rs-slides_style', get_stylesheet_directory_uri() . '/css/responsiveslides.css', false, '1.51', 'all' );
		wp_register_style( 'rs-woocommerce', get_stylesheet_directory_uri() . '/css/woocommerce.css', false, '1.0.0', 'all' );
		wp_register_style( 'rs-woocommerce-layout', get_stylesheet_directory_uri() . '/css/woocommerce-layout.css', false, '1.0.0', 'all' );
		
		wp_register_style( 'rs-fancybox_style', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css', false, '1.51', 'all' );
	}

	function enqueue_theme_styles_scripts()
	{	
		if ( is_singular() ) 
			wp_enqueue_script( 'comment-reply' );
			
		wp_enqueue_script( 'rs-modernizr_scripts' );
		wp_enqueue_script( 'rs-superfish_script' );
		wp_enqueue_script( 'rs-supersubs_script' );
		wp_enqueue_script( 'rs-slides_script' );
		
		wp_enqueue_script( 'rs-fancybox_script' );
		wp_enqueue_script( 'rs-fancybox_media_script' );
		wp_enqueue_script( 'rs-placeholder_script' );
		wp_enqueue_script( 'rs-cycle_script' );
		
		wp_enqueue_script( 'rs-storelocator_script' );
		wp_enqueue_script( 'rs-geocode_script' );
		
		wp_enqueue_script( 'rs-theme_scripts' );
		
		wp_enqueue_style( 'rs-font_awesome_style' );
		wp_enqueue_style( 'rs-font_awesome-corp_style' );
		wp_enqueue_style( 'rs-font_awesome-extstyle' );
		wp_enqueue_style( 'rs-font_awesome-social_style' );
		wp_enqueue_style( 'rs-responsive_style' );
		wp_enqueue_style( 'rs-slides_style' );
		wp_enqueue_style( 'rs-woocommerce' );
		wp_enqueue_style( 'rs-woocommerce-layout' );
		
		wp_enqueue_style( 'rs-fancybox_style' );
	}

}

?>