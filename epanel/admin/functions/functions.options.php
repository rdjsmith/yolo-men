<?php

add_action( 'init', 'of_options' );

if ( ! function_exists('of_options') )
{
	function of_options()
	{
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		$options_pages[''] = 'Select a category:';
		foreach ($options_categories_obj as $category) {
			$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		// Pull all the pages into an array
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = 'Select a page:';
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
		}
		
		// Pull all the posts into an array
		$options_posts = array();  
		$options_posts_obj = get_posts('orderby=post_date');
		$options_posts[''] = 'Select a post:';
		foreach ($options_posts_obj as $post) {
			$options_posts[$post->ID] = $post->post_title;
		}
		
		// Pull all the product into an array
		$options_products = array();  
		
		$args = array(
			'post_type'			=> 'product',
			'posts_per_page'	=> -1
		);
		
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {
			
			$options_products[''] = 'Select a product:';
			
			while ( $the_query->have_posts() ) { $the_query->the_post();
				// assign options
				$options_products[ get_the_ID() ] = get_the_title();
			}
		} else {
			// no posts found
		}
		
		/* Restore original Post Data */
		wp_reset_postdata();
		
		
		$of_blog_layout = array(
			"1"	=> "1",
			"2" => "2"
		);
		
		// instagram image sizes
		$of_instagram_select = array(
			"low_resolution" 		=> "Low Resolution",
			"thumbnail" 			=> "Thumbnail",
			"standard_resolution" 	=> "Standard Resolution"
		); 
		
		//Testing 
		$of_options_select = array( "one", "two", "three", "four", "five" ); 
		$of_options_radio = array( "one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five" );
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/patterns/'; 				// change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/patterns/'; 	// change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");
		$email_to = get_option('admin_email');


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;

$of_options = array();
$short_name = 'rsclean';

	
// heading General Settings
$of_options[] = array( 
	"name" => "General Settings",
	"type" => "heading"
);
	
	$of_options[] = array(
		"name" => "Hello there!",
		"desc" => "",
		"id" => "introduction",
		"std" => "<h3 style=\"margin: 0 0 10px;\">Thank you for buying this theme</h3>
			Thank you for using this theme. It only takes a few minutes to work through the configuration and be up and running.",
		"icon" => true,
		"type" => "info"
	);

	$of_options[] = array(
		"name" => "Logo",
		"desc" => "Add the URL to link to your logo, or upload a file from your computer.",
		"id" => $short_name."_logo",
		"std" => get_template_directory_uri() ."/images/logo.png",
		"type" => "upload"
	);
		
	$of_options[] = array( 
		"name" => "Custom Favicon",
		"desc" => "A favicon is a 16x16 pixel icon that represents your site.",
		"id" => $short_name."_favicon",
		"std" => get_template_directory_uri() ."/favicon.ico",
		"type" => "upload"
	);
		
	$of_options[] = array( 
		"name" => "Google Analytics",
		"desc" => "Paste your Google Analytics (or other) tracking code here.",
		"id" => $short_name."_ga_code",
		"std" => "",
		"type" => "textarea"
	);
	
	
	// Homepage
	$of_options[] = array( 
		"name" => "Homepage",
		"type" => "heading"
	);
		$of_options[] = array(
			"name" => "Slider Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Slider Settings</h3>
				Add or modify slider here.",
			"icon" => true,
			"type" => "info"
		);
			
			$of_options[] = array( 
				"name" => "Enable Slider",
				"desc" => 'If check it will display slider in home page area.',
				"id" => $short_name."_enable_slider",
				"std" => '1',
				"type" => "checkbox"
			);
			
			$of_options[] = array( 
				"name" => "Sliders",
				"desc" => "Create new slider here.",
				"id" => $short_name."_homepage_sliders",
				"std" => "",
				"type" => "slider"
			);
			
		$of_options[] = array(
			"name" => "Philosophy Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Philosophy Settings</h3>
				Add or modify philosophy text here.",
			"icon" => true,
			"type" => "info"
		);
			$of_options[] = array( 
				"name" => "Philosophy Title",
				"desc" => 'Add and update philosophy title.',
				"id" => $short_name."_philosophy_title",
				"std" => 'Philosophy',
				"type" => "text"
			);
			$of_options[] = array( 
				"name" => "Philosophy Description",
				"desc" => 'Add and update philosophy description here.',
				"id" => $short_name."_philosophy_description",
				"std" => '',
				"type" => "textarea"
			);
			
		$of_options[] = array(
			"name" => "Latest Collection",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Latest Collection</h3>
				Add or modify latest collection pages here.",
			"icon" => true,
			"type" => "info"
		);
			$of_options[] = array( 
				"name" => "Collection 1",
				"desc" => "Select your first collection.",
				"id" => $short_name."_collection_1",
				"std" => '',
				"type" => "select",
				"class" => "small", //mini, tiny, small
				"options" => $options_products
			);
			$of_options[] = array( 
				"name" => "Collection 2",
				"desc" => "Select your first collection.",
				"id" => $short_name."_collection_2",
				"std" => '',
				"type" => "select",
				"class" => "small", //mini, tiny, small
				"options" => $options_products
			);
			$of_options[] = array( 
				"name" => "Collection 3",
				"desc" => "Select your first collection.",
				"id" => $short_name."_collection_3",
				"std" => '',
				"type" => "select",
				"class" => "small", //mini, tiny, small
				"options" => $options_products
			);
			$of_options[] = array( 
				"name" => "Collection 4",
				"desc" => "Select your first collection.",
				"id" => $short_name."_collection_4",
				"std" => '',
				"type" => "select",
				"class" => "small", //mini, tiny, small
				"options" => $options_products
			);
			
		$of_options[] = array(
			"name" => "Instagram Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Instagram Settings</h3>
				Add or modify latest instagram here.",
			"icon" => true,
			"type" => "info"
		);
			$of_options[] = array( 
				"name" => "Client ID",
				"desc" => "Your profile ID, find out <a href='http://jelled.com/instagram/lookup-user-id' target='_blank'>here</a>",
				"id" => $short_name."_instagram_client_id",
				"std" => "",
				"type" => "text"
			);
			$of_options[] = array( 
				"name" => "Count",
				"desc" => "Number of image to return.",
				"id" => $short_name."_instagram_count",
				"std" => "",
				"type" => "text"
			);
			$of_options[] = array( 
				"name" 	=> "Display Size",
				"desc" 	=> "Upload or paste resource image url in the left side box.",
				"id" 	=> $short_name."_instagram_display_size",
				"std" 	=> "",
				"type" 		=> "select",
				"class" 	=> "small",
				"options" 	=> $of_instagram_select	
			);
			$of_options[] = array( 
				"name" => "Access Token",
				"desc" => "Number of image to return, don't know how is this? try this <a href='http://www.pinceladasdaweb.com.br/instagram/access-token/' target='_blank'>generator</a> instead.</small>",
				"id" => $short_name."_instagram_access_token",
				"std" => "",
				"type" => "text"
			);
		
		$of_options[] = array(
			"name" => "Resources Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Resources Settings</h3>
				Add or modify latest resources setting here.",
			"icon" => true,
			"type" => "info"
		);
			$of_options[] = array( 
				"name" => "Resource Image",
				"desc" => "Upload or paste resource image url in the left side box.",
				"id" => $short_name."_resource_image",
				"std" => "",
				"type" => "upload"
			);
	
	// heading Product Settings
	$of_options[] = array( 
		"name" => "Single Product",
		"type" => "heading"
	);
		$of_options[] = array(
			"name" => "Product Settings",
			"desc" => "",
			"id" => "introduction",
			"std" => "<h3 style=\"margin: 0 0 10px;\">Product Settings</h3>
				Add or modify single product settings here.",
			"icon" => true,
			"type" => "info"
		);
		$of_options[] = array( 
			"name" => "First Column",
			"desc" => "Add or Update single product first column banner here.",
			"id" => $short_name."_first_product_banner",
			"std" => "FREE STANDARD SHIPPING ON ORDERS OVER $50!",
			"type" => "textarea"
		);
		$of_options[] = array( 
			"name" => "Second Column",
			"desc" => "Add or Update single product second column banner here.",
			"id" => $short_name."_second_product_banner",
			"std" => "EXPRESS SHIPPING NOW AVAILABLE!",
			"type" => "textarea"
		);
		$of_options[] = array( 
			"name" => "Third Column",
			"desc" => "Add or Update single product third column banner here.",
			"id" => $short_name."_third_product_banner",
			"std" => "WOMEN'S 2 FOR $50 FLEECE",
			"type" => "textarea"
		);
		
		
	// Blog
	$of_options[] = array( 
		"name" => "Blog",
		"type" => "heading"
	);		
		$of_options[] = array( 
			"name" => "Enable Comment in Posts",
			"desc" => "If check it will display comment form in posts.",
			"id" => $short_name."_enable_postcomment",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Enable Comment in Pages",
			"desc" => "If check it will display comment form in pages.",
			"id" => $short_name."_enable_pagecomment",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Enable Page Meta",
			"desc" => "If check it will display page meta.",
			"id" => $short_name."_enable_pagemeta",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Enable Post Meta",
			"desc" => "If check it will display post meta.",
			"id" => $short_name."_enable_postmeta",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Enable Page Breadcrumb",
			"desc" => "If check it will display page Breadcrumb.",
			"id" => $short_name."_enable_pagebreadcrumb",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Enable Post Breadcrumb",
			"desc" => "If check it will display post Breadcrumb.",
			"id" => $short_name."_enable_postbreadcrumb",
			"std" => '1',
			"type" => "checkbox"
		);
		$of_options[] = array( 
			"name" => "Other Settings",
			"desc" => "Select Archive, Category, Tag pages layout in column(s).",
			"id" => $short_name."_blog_layout",
			"std" => '2',
			"type" => "select",
			"class" => "small", //mini, tiny, small
			"options" => $of_blog_layout
		);
		
	
	// Backup
	$of_options[] = array( 
		"name" => "Social Profiles",
		"type" => "heading"
	);
		$of_options[] = array( 
			"name" => "Facebook Username",
			"desc" => "",
			"id" => $short_name."_facebook_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Twitter Username",
			"desc" => "",
			"id" => $short_name."_twitter_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Instagram Username",
			"desc" => "",
			"id" => $short_name."_instagram_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Pinterest Username",
			"desc" => "",
			"id" => $short_name."_pinterest_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Google Plus URL",
			"desc" => "",
			"id" => $short_name."_googleplus_url",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Flickr Username",
			"desc" => "",
			"id" => $short_name."_flickr_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Youtube Username",
			"desc" => "",
			"id" => $short_name."_youtube_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Linkedin URL",
			"desc" => "",
			"id" => $short_name."_linkedin_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Vimeo Username",
			"desc" => "",
			"id" => $short_name."_vimeo_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Digg Username",
			"desc" => "",
			"id" => $short_name."_digg_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Dribble Username",
			"desc" => "",
			"id" => $short_name."_dribble_username",
			"std" => "",
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Tumblr URL",
			"desc" => "",
			"id" => $short_name."_tumblr_username",
			"std" => "",
			"type" => "text"
		);
		

	// Contact	
	$of_options[] = array( 
		"name" => "Contact",
		"type" => "heading"
	);	
		
		$of_options[] = array( 
			"name" => "Email Address",
			"desc" => "Enter which email address will be sent from contact form",
			"id" => $short_name."_contact_email",
			"std" => $email_to,
			"type" => "text"
		);
		$of_options[] = array( 
			"name" => "Thank you message",
			"desc" => "Enter message display once form submitted.",
			"id" => $short_name."_contact_message",
			"std" => 'Thank you! We will get back to you as soon as possible',
			"type" => "textarea"
		);
		
	
	// Footer
	$of_options[] = array( 
		"name" => "Footer",
		"type" => "heading"
	);
		
		$of_options[] = array( 
			"name" => "Footer text",
			"desc" => "Enter footer text ex. copyright description",
			"id" => $short_name."_footer_text",
			"std" => 'Copyright 2012. Powered by <a href="http://wordpress.org/">Wordpress</a>.',
			"type" => "textarea"
		);
			
	// Backup
	$of_options[] = array( 
		"name" => "Backup Options",
		"type" => "heading"
	);

		$of_options[] = array( 
			"name" => "Backup and Restore Options",
			"id" => "of_backup",
			"std" => "",
			"type" => "backup",
			"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
		);
		$of_options[] = array( 
			"name" => "Transfer Theme Options Data",
			"id" => "of_transfer",
			"std" => "",
			"type" => "transfer",
			"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
		);
		
	}
}
?>
