<?php

class RS_Category_Feeds_Widget extends WP_Widget {
	
	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var defaults
	 */
	protected $defaults;
	
	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {
		$this->defaults = array(
			'title'			=> 'RS Category Feeds',
			'categories'	=> ''
		);

		$widget_ops = array(
			'classname'   => 'rs-category-widget',
			'description' => __( 'RSS Feeds by selected categories.', THEME_DOMAIN )
		);

		$control_ops = array(
			'id_base' => 'rs-category-widget',
			'width'   => 240,
			'height'  => 300
		);

		$this->WP_Widget( 'rs-category-widget', __( 'Category Feed Links', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', __($instance['title']));
		$categories = $instance['categories'];

		echo $before_widget;
		
		if( ! empty( $instance['title'] ) ):
			?><h3 class="widget-title"><?php _e( $title, THEME_DOMAIN ); ?></h3><?php 
		else : 
			?><h3 class="widget-title"><?php _e('RSS Feeds'); ?></h3><?php 
		endif;
		
		echo '<ul class="categories">';
			if( ! $categories ) {
				$category_ids = get_all_category_ids();
			} else {
				$category_ids = explode(',', $categories);
			}
			foreach( $category_ids as $cat_id ) {
				echo '<li><a href="' . get_category_feed_link($cat_id) . '" title="' . __('RSS Feed', THEME_DOMAIN) . '" target="_blank">' . get_cat_name($cat_id) . '</a></li>';
			}
		echo '</ul>';

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		
		return $instance;
	}
	
	function form( $instance ) {
		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		?>
		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', THEME_DOMAIN); ?>: </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories separated by comma', THEME_DOMAIN); ?>: </label>
				<input class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo esc_attr( $categories ); ?>" />
			</p>
		</div>
		<?php
	}
	
	
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-category-widget', true ) ) {
			wp_enqueue_style( 'rs_category_widget_style', get_template_directory_uri().'/lib/rs-category-widget/rs-category-widget.css', false, '1.0.0', 'all' );
		}
	}

}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Category_Feeds_Widget', 'enqueue_assets' ) );