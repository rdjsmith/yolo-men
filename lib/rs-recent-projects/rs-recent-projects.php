<?php

class RS_Recent_Projects extends WP_Widget {

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
			'title'			=> 'Recent Projects',
			'post_count'	=> '5'
		);

		$widget_ops = array(
			'classname'   => 'rs-recent-projects',
			'description' => __( 'Displays recent project with thumbnails.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-recent-projects',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-recent-projects', __( 'RS Recent Projects', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="recentProjects">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widgetTitle"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php else : ?>
				<h3 class="widgetTitle"><?php _e('Recent Projects'); ?></h3>
			<?php endif; ?>

				<ul class="projects no-bullet">
					<?php
						$post_count = $instance['post_count'];
						
						$args = array(
							'post_type' 		=> 'portfolio',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $post_count
						);
						
						$latest_posts = new WP_Query( $args );
						
						if( $latest_posts ) {
							while( $latest_posts->have_posts() ) {
								$latest_posts->the_post();
								?>
									<li class="projectItem">
										<div class="left postThumbnail">
											<?php
												$attr = array(
													'class'	=> "recentProjectMedia",
													'alt'	=> trim(strip_tags( get_the_title() )),
													'title'	=> trim(strip_tags( get_the_title() ))
												);
												echo '<a href="'. esc_url( get_permalink() ) .'" data-rel="fancybox">' . get_the_post_thumbnail( get_the_ID(), array(75, 55), $attr ) . '</a>';
											?>
										</div>
										<h4 class="recentProjectTitle">
											<a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( get_the_title() ); ?>"><?php echo the_title(); ?></a>
										</h4>
										<span class="recentProjectCategory">
											<?php
												// add separator for two or more terms
												$separtor = ' ';
												
												// get lits of term associated in the current taxonomy
												$terms = get_the_terms( get_the_ID(), 'portfolio-category' );
												foreach ( $terms as $term ) {
													// get term link, the function name explain it
													$term_link = get_term_link( $term, 'portfolio-category' );
													if( is_wp_error( $term_link ) )
														continue;
														
													echo $separtor . '<a href="'. $term_link .'">'. $term->name . '</a>';
													$separtor = ', ';
												}
											?>
										</span>
										
										<div class="clear"></div>
									</li>
								<?php
							}
							
							// Restore original Post Data
							wp_reset_postdata();
						}
					?>
				</ul>
			
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
				<small>defualt is <strong>5</strong></small>
			</p>
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-recent-projects', true ) ) {
			wp_enqueue_style( 'rs_recent_projects_style', get_template_directory_uri().'/lib/rs-recent-projects/rs-recent-projects.css', false, '1.0.0', 'all' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Recent_Projects', 'enqueue_assets' ) );