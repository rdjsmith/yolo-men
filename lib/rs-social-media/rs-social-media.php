<?php

class RS_Social_Media extends WP_Widget {

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
			'title' 			=> __('Connect', THEME_DOMAIN), 
			'facebook_url' 		=> '', 
			'twitter_username' 	=> '', 
			'linkedin_url' 		=> '', 
			'youtube_username' 	=> '', 
			'rss_url' 			=> ''
		);

		$widget_ops = array(
			'classname' => 'rs-social-media', 
			'description' => __('A widget that display social medias icons.', THEME_DOMAIN)
		);

		$control_ops = array(
			'id_base' => 'rs-social-media',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-social-media', __( 'RS Social Media', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
		<div class="rs-social-media-wrapper">
			<div id="rs_contact_wrapper">
				
				<?php if( !empty( $instance['title'] ) ): ?>
					<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
				<?php else : ?>
					<h3 class="widget-title"><?php _e('Connect'); ?></h3>
				<?php endif; ?>
				
				<ul class="social-medias no-bullet">
					<li><a href="<?php echo $instance['facebook_url']; ?>" alt="Facebook"><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/rs-social-media/images/facebook.png" alt="Facebook" /></a></li>
					<li><a href="https://twitter.com/<?php echo $instance['twitter_username']; ?>" alt="Twitter"><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/rs-social-media/images/twitter.png" alt="Twitter" /></a></li>
					<li><a href="<?php echo $instance['linkedin_url']; ?>" alt="Linkedin"><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/rs-social-media/images/linkedin.png" alt="Linkedin" /></a></li>
					<li><a href="http://www.youtube.com/user/<?php echo $instance['youtube_username']; ?>" alt="Youtube"><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/rs-social-media/images/youtube.png" alt="Youtube" /></a></li>
					<li><a href="<?php echo $instance['rss_url']; ?>" alt="RSS"><img src="<?php echo get_stylesheet_directory_uri(); ?>/lib/rs-social-media/images/rss.png" alt="RSS" /></a></li>
				</ul>
				
			</div>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['facebook_url'] 	= strip_tags( $new_instance['facebook_url'] );
		$instance['twitter_username'] 	= strip_tags( $new_instance['twitter_username'] );
		$instance['linkedin_url'] 	= strip_tags( $new_instance['linkedin_url'] );
		$instance['youtube_username'] 	= strip_tags( $new_instance['youtube_username'] );
		$instance['rss_url'] 	= strip_tags( $new_instance['rss_url'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults ); 
		?>

		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e( 'Facebook URL', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" value="<?php echo esc_url( $instance['facebook_url'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e( 'Twitter Username', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo esc_attr( $instance['twitter_username'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'linkedin_url' ); ?>"><?php _e( 'Linkedin URL', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'linkedin_url' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_url' ); ?>" value="<?php echo esc_attr( $instance['linkedin_url'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'youtube_username' ); ?>"><?php _e( 'Youtube Username', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'youtube_username' ); ?>" name="<?php echo $this->get_field_name( 'youtube_username' ); ?>" value="<?php echo esc_attr( $instance['youtube_username'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'rss_url' ); ?>"><?php _e( 'RSS URL', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'rss_url' ); ?>" name="<?php echo $this->get_field_name( 'rss_url' ); ?>" value="<?php echo esc_attr( $instance['rss_url'] ); ?>" class="widefat" />
			</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-social-media', true ) ) {
			wp_enqueue_style( 'RS_Social_Media_style', get_template_directory_uri().'/lib/rs-social-media/rs-social-media.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Social_Media', 'enqueue_assets' ) );

?>