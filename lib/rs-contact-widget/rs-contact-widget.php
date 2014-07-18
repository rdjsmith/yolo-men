<?php

class RS_Contact extends WP_Widget {
	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	
	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {
	
		$this->defaults = array( 
			'title' => __( 'RS Contact', THEME_DOMAIN )
		);
		
		/* Widget settings. */
		$widget_ops = array( 
			'classname' 	=> 'rs-contact-widget', 
			'description' 	=> __( 'Contact Form Widget.', THEME_DOMAIN ) 
		);

		/* Widget control settings. */
		$control_ops = array( 
			'width' 	=> 300, 
			'height' 	=> 350,
			'id_base'	=> 'rs-contact-widget' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'rs-contact-widget', __( 'RS Contact', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$title = apply_filters('Last From Port', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if( $title ) 
			echo $before_title . "<span class=\"contact-icon\"></span>" . $title . $after_title;
		?>
		
		<div class="rs-contact-widget-whole"> 				
			<div id="rs_contact_wrapper">
				<form method="post" id="rs_contact_widget">
					<?php
						if ( function_exists( 'wp_nonce_field' ) ) 
							wp_nonce_field( 'rs_contact_action', 'rs_contact_nonce' );
					?>
					<p><label for="name_widget"><?php _e( 'Name *', THEME_DOMAIN ); ?></label>
						<input type="text" name="name" id="name_widget" />
					</p>
					<p><label for="email_widget"><?php _e( 'Email *', THEME_DOMAIN ); ?></label>
						<input type="email" name="email" id="email_widget" />
					</p>
					<p><label for="comment_widget"><?php _e( 'Message *', THEME_DOMAIN ); ?></label>
						<textarea name="message" id="comment_widget" rows="4" cols="40"></textarea>
					</p>
					<p>
						<input type="submit" id="submit" class="button" value="Submit" /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
					</p>
				</form>
				
				<div id="message" class="alert-box"></div>
			</div>
		<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "</div>";
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', THEME_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<?php
	}
	
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-contact-widget', true ) ) {
			wp_enqueue_style( 'rs_contact_style', get_template_directory_uri().'/lib/rs-contact-widget/rs-contact-widget.css', false, '1.0.0', 'all' );
		}
	}
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Contact', 'enqueue_assets' ) );

?>