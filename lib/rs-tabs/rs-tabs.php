<?php

class RS_Tabs extends WP_Widget {

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
			'title'			=> 'RS Tabs'
		);

		$widget_ops = array(
			'classname'   => 'rs-tabs',
			'description' => __( 'Displays latest posts, comments and tags.', THEME_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-tabs',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-tabs', __( 'RS Tabs', THEME_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
		?>
		
		<div class="rs-tabs-wrapper">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widget-title"><?php _e( $instance['title'], THEME_DOMAIN ); ?></h3>
			<?php endif; ?>
			
			<ul class="tabs no-bullet">
				<li><a href="#tab-latest">Latest</a></li>
				<li><a href="#tab-comments">Comments</a></li>
				<li><a href="#tab-tags">Tags</a></li>
			</ul>
			<div id="tab-latest">
				<ul class="tab-latest">
					<?php
						$args = array(
							'post_type' 	=> 'post',
							'post_status'	=> 'publish',
							'orderby'       => 'post_date',
							'order'         => 'DESC',
							'post_count'	=> 5
						);
						
						$latest_posts = new WP_Query( $args );
						
						if( $latest_posts ) {
							while( $latest_posts->have_posts() ) {
								$latest_posts->the_post();
								?>
									<li><a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( get_the_title() ); ?>"><?php echo the_title(); ?></a><span class="date-posted"><?php the_date('M j, Y'); ?></span></li>
								<?php
							}
							
							wp_reset_query();
						}
					?>
				</ul>
				
			</div>
			<div id="tab-comments">
				<ul class="tab-comments">
					<?php
						$args = array(
							'number'	=> 5,
						);
						$comments = get_comments();
						foreach( $comments as $comment )
						{
							$comment_post = get_post( $comment->comment_post_ID ); 
							$comment_content = $comment->comment_content;
							?>
								<li id="li-comment-<?php echo $comment->comment_ID; ?>">
									<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo $comment->comment_author . ' on ' . esc_attr( $comment_post->post_title ); ?>">
										<?php echo $comment->comment_author . ': ';
											if( strlen( $comment_content ) > 50 )
												echo substr( $comment_content, 0, 50 ) . '...';
											else
												echo $comment_content;
										?>
									</a>
								</li>
							<?php
						}
					?>
				</ul>
			</div>
			<div id="tab-tags">
				<?php
					$args = array(
						'smallest'                  => 8, 
						'largest'                   => 22,
						'unit'                      => 'pt', 
						'number'                    => 45,  
						'format'                    => 'flat',
						'separator'                 => ", ",
						'orderby'                   => 'name', 
						'order'                     => 'ASC',
						'exclude'                   => null, 
						'include'                   => null, 
						'topic_count_text_callback' => 'default_topic_count_text',
						'link'                      => 'view', 
						'taxonomy'                  => 'post_tag', 
						'echo'                      => true
					);
					
					wp_tag_cloud( $args );
				?>
			</div>
		</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']			= $new_instance['title'];
		
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
		</div>
		<?php
	}
		
	function enqueue_assets() {
		if( is_active_widget( false, false, 'rs-tabs', true ) ) {
			wp_enqueue_style( 'rs_tabs_style', get_template_directory_uri().'/lib/rs-tabs/rs-tabs.css', false, '1.0.0', 'all' );
			
			wp_enqueue_script( 'rs_tabs_script', get_template_directory_uri().'/lib/rs-tabs/rs-tabs.js', array('jquery'), '1.0' );
		}
	}
	
}

/* enable embeed style */
add_action( 'wp_enqueue_scripts', array('RS_Tabs', 'enqueue_assets' ) );

?>