<?php

class RS_Twitter extends WP_Widget {

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
			'title' 			=> __('Twitter Widget', THEME_DOMAIN), 
			'twitter_username' 	=> '', 
			'show_num' 			=> '5',
			'follow_link'		=> ''
		);

		$widget_ops = array(
			'classname' => 'rs-twitter', 
			'description' => __('A widget that show Twitter feeds.', THEME_DOMAIN)
		);

		$control_ops = array(
			'id_base' => 'rs-twitter',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-twitter', __( 'RS Twitter', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title 				= apply_filters('Twitter', $instance['title'] );
		$twitter_username 	= $instance['twitter_username'];
		$show_num 			= $instance['show_num'];
		$follow_link 		= $instance['follow_link'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if($title)
			echo $before_title . "<span class=\"twitter-icon\"></span>" . $title . $after_title;
			
		/* Display the widget title if one was input (before and after defined by themes). */
		?>
		<div class="twitter-whole"> 
			<ul id="twitter_update_list"><li>Twitter feed loading</li></ul>
			
			<?php if( $follow_link ) { ?>
				<div class="twitter-link">
					<a href="http://www.twitter.com/<?php echo $twitter_username; ?>"><span>Follow</span> @<?php echo $twitter_username; ?></a>
				</div>
			<?php } ?>
		</div>
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
		?>
		<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $twitter_username;?>.json?callback=twitterCallback2&amp;count=<?php echo $show_num;?>"></script>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['twitter_username'] 	= strip_tags( $new_instance['twitter_username'] );
		$instance['show_num'] 			= strip_tags( $new_instance['show_num'] );
		$instance['follow_link'] 		= strip_tags( $new_instance['follow_link'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', THEME_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('Twitter username', THEME_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count', THEME_DOMAIN); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'follow_link' ); ?>"><?php _e('Display Follow Button', THEME_DOMAIN); ?></label>
			<select name="<?php echo $this->get_field_id( 'follow_link' ); ?>" id="<?php echo $this->get_field_id( 'follow_link' ); ?>" class="widefat">
				<option value="1" <?php selected( $instance['follow_link'], 1 ); ?>>Yes</option>
				<option value="0" <?php selected( $instance['follow_link'], 0 ); ?>>No</option>
			</select>
		</p>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-twitter', true ) ) {
			wp_enqueue_style( 'rs_twitter_style', get_template_directory_uri().'/lib/rs-twitter/rs-twitter.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Twitter', 'enqueue_assets' ) );

?>