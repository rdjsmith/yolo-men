<?php
/*
Template Name: Contact
*/

?>

<?php get_header(); ?>
<?php the_post(); ?>

	<div class="row">
		<div class="eight columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<div class="row">
				<div class="twelve columns">
					<div class="main-content">
						<h2 class="page-title"><?php the_title(); ?></h2>
						
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="twelve columns">
					<div id="rs_contact_wrapper">
						<form method="post" id="rs_contact">
							<?php
								if ( function_exists( 'wp_nonce_field' ) ) 
									wp_nonce_field( 'rs_contact_action', 'rs_contact_nonce' );
							?>
							<p><label for="name"><?php _e( 'Name *', RS_DOMAIN ); ?></label>
								<input type="text" name="name" id="name" />
							</p>
							<p><label for="email"><?php _e( 'Email *', RS_DOMAIN ); ?></label>
								<input type="email" name="email" id="email" />
							</p>
							<p><label for="comment"><?php _e( 'Message *', RS_DOMAIN ); ?></label>
								<textarea name="message" id="comment" rows="10" cols="40"></textarea>
							</p>
							<p>
								<input type="submit" id="submit" class="button" value="Submit" /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
							</p>
						</form>
						
						<div id="message" class="alert-box"></div>
					</div>
					
				</div>
			</div>
			
			<div class="row">
				<div class="twelve columns">
					<div class="edit-post">
						<?php edit_post_link( __('{ Edit }', THEME_DOMAIN), '<span class="small">', '</span>' ); ?>
					</div>
				</div>
			</div>
			
		</div>
		
		<!--sidebar-->
		<?php get_sidebar(); ?>
		
	</div>

<?php get_footer(); ?>