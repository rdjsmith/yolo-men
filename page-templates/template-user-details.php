<?php
/*
Template Name: User Update Details
*/
?>

<?php get_header(); ?>
	
    <!-- contact content -->
    <div class="row">
	
		<div class="eight columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>

			<div id="rs_user_update_wrapper">
				<?php if ( is_user_logged_in() ) {
				
						global $current_user;
						get_currentuserinfo();
					?>
				
					<form method="post" id="rs_user_update">
						<?php
							if ( function_exists( 'wp_nonce_field' ) ) 
								wp_nonce_field( 'rs_user_update_action', 'rs_user_update_nonce' );
						?>
						<p><label for="last_name"><?php _e( 'Last Name', THEME_DOMAIN ); ?></label>
							<?php $last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : $current_user->user_lastname; ?>
							<input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" />
						</p>
						<p><label for="first_name"><?php _e( 'First Name', THEME_DOMAIN ); ?></label>
							<?php $first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : $current_user->user_firstname; ?>
							<input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" />
						</p>
						<p><label for="email"><?php _e( 'Email', THEME_DOMAIN ); ?></label>
							<?php $email = isset( $_POST['email'] ) ? $_POST['email'] : $current_user->user_email; ?>
							<input type="email" name="email" id="email" value="<?php echo $email; ?>" />
						</p>
						<p><label for="username"><?php _e( 'Username', THEME_DOMAIN ); ?></label>
							<?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : $current_user->user_login; ?>
							<input type="text" name="username" id="username" value="<?php echo $user_login; ?>" disabled="disabled" /> <small><em>Usernames cannot be changed.</em></small>
						</p>
						<p><label for="password"><?php _e( 'Password', THEME_DOMAIN ); ?></label>
							<input type="password" name="pwd1" id="pwd1" />
						</p>
						<p><label for="password_again"><?php _e( 'Password again', THEME_DOMAIN ); ?></label>
							<input type="password" name="pwd2" id="pwd2" />
						</p>
						<p>
							<input type="submit" id="submit" class="button" value="Update Profile" /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
						</p>
						
						<div id="message" class="alert-box"></div>
					</form>
				
				<?php } else { ?>
					
					<h4>Oops</h4>
					<p>You need to <a href="<?php echo get_permalink( 69 ); ?>">login</a> first to update your profile.</p>
					
				<?php } ?>
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