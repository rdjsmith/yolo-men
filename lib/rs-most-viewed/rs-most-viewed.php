<?php

class RS_Most_Viewed extends WP_Widget {

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
			'title'			=> 'Most Viewed',
			'post_count'	=> '5'
		);

		$widget_ops = array(
			'classname'   => 'rs-most-viewed',
			'description' => __( 'Displays most popular posts.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-most-viewed',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-most-viewed', __( 'RS Most Viewed', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) 
	{
		global $wpdb;
		
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="rs-most-viewed-wrapper">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widgetTitle"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php else : ?>
				<h3 class="widgetTitle"><?php _e('Most Viewed'); ?></h3>
			<?php endif; ?>

			<div class="popuparPosts">
				<ul class="popularPost no-bullet">
					<?php
						$post_count = $instance['post_count'];
						
						$args = array(
							'post_type' 		=> 'post',
							'orderby' 			=> 'comment_count',
							'order' 			=> 'DESC',
							'posts_per_page'	=> $post_count
						);
						
						// The Query
						$query = new WP_Query( $args );

						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) :  $query->the_post();
								?>
									<li class="popularPostItem">
										<div class="left postThumbnail">
											<?php
												$attr = array(
													'class'	=> "blog-attachment-media",
													'alt'	=> trim(strip_tags( get_the_title() ))
												);
												echo '<a href="'. esc_url( get_permalink() ).'">'.get_the_post_thumbnail( get_the_ID(), array(75, 55), $attr ).'</a>';
											?>
										</div>
										<h4 class="popularPostTitle">
											<a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( get_the_title() ); ?>"><?php echo the_title(); ?></a>
										</h4>
										<span class="popularPostCategory"><?php echo get_the_category_list( ', ' ); ?></span>
										
										<div class="clear"></div>
									</li>
								<?php
							endwhile;
						}
						
						// Restore original Post Data
						wp_reset_postdata();
					?>
				</ul>
			</div>

		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']			= $new_instance['title'];
		$new_instance['post_count'] 	= $new_instance['post_count'];
		
		return $new_instance;
	}

	function form( $instance ) {
		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number of Post', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" class="widefat" />
			</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-most-viewed', true ) ) {
			wp_enqueue_style( 'rs_most_viewed_style', get_template_directory_uri().'/lib/rs-most-viewed/rs-most-viewed.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Most_Viewed', 'enqueue_assets' ) );