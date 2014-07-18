<?php

class RS_Client_Review extends WP_Widget {

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
			'title' 			=> __('Client Review', THEME_DOMAIN), 
			'facebook_url' 		=> '', 
			'review_count'	=> 2
		);

		$widget_ops = array(
			'classname' => 'rs-client-review', 
			'description' => __('A widget that display client review/testimonial.', THEME_DOMAIN)
		);

		$control_ops = array(
			'id_base' => 'rs-client-review',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-client-review', __( 'RS Client Review', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
		<div class="rs-client-review-wrapper">
			<div id="rs_contact_wrapper">
				
				<?php if( !empty( $instance['title'] ) ): ?>
					<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
				<?php else : ?>
					<h3 class="widget-title"><?php _e('Client Review'); ?></h3>
				<?php endif; ?>
				
				<ul class="testimonial no-bullet">
					<?php
						$num_review = $instance['review_count'];
						
						$args = array(
							'post_type'		=> 'review',
							'posts_per_page'=> $num_review
						);
						
						$query = new WP_Query( $args );
						if( $query->have_posts() ) {
							while( $query->have_posts() ) : $query->the_post();
								$review_author = get_post_meta( get_the_ID(), 'review_author', true );
								$review_url = get_post_meta( get_the_ID(), 'review_url', true );
								?>
									<li class="testimonial-item">
										<div class="testimonial-body">
											<?php the_content(); ?>
											
											<div class="testimonial-author">
												<strong>
													<?php
														$separator = '';
														if( $review_url ) 
															$separator = ', ';
														echo $review_author . $separator . $review_url; 
													?>
												</strong>
											</div>
										</div>

									</li>
								<?php 
							endwhile;
						}
					?>
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
		$instance['review_count'] 	= strip_tags( $new_instance['review_count'] );

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
				<label for="<?php echo $this->get_field_id( 'review_count' ); ?>"><?php _e( 'Number of review', THEME_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'review_count' ); ?>" name="<?php echo $this->get_field_name( 'review_count' ); ?>" value="<?php echo esc_attr( $instance['review_count'] ); ?>" class="widefat" />
			</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-client-review', true ) ) {
			wp_enqueue_style( 'RS_Client_Review_style', get_template_directory_uri().'/lib/rs-client-review/rs-client-review.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Client_Review', 'enqueue_assets' ) );

?>