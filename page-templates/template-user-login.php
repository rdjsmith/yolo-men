<?php
/*
Template Name: User Login
*/
?>

<?php get_header(); ?>
<?php the_post(); ?>
	
    <!-- contact content -->
    <div class="row">
	
		<div class="eight columns">
			<!--breabcrumbs-->
			<?php
				if( $data['rsclean_enable_pagebreadcrumb'] )
					include( BREADCRUMBS );
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="page-title"><?php the_title(); ?></h2>
				<?php
					if( $data['rsclean_enable_pagemeta'] )
						include( POST_INFO );
				?>
				
				<div class="entry">
					<?php the_content(); ?>
				</div>
			</article>
			
			<div id="rs_user_login_wrapper">
				<?php if ( is_user_logged_in() ) {
				
						global $current_user;
						get_currentuserinfo();
						
					?>
					<p>You already signed in on this site, visit <a href="<?php echo get_permalink( 128 ); ?>">client</a> page.</p>
					<p>
						Welcome <strong><?php echo !empty( $current_user->user_firstname ) ? $current_user->user_firstname .' '. $current_user->user_lastname : $current_user->user_login; ?></strong> 
						<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" class="button small">Logout</a>
					</p>
				<?php } else { ?>
					<form method="post" id="rs_user_login">
						<?php
							if ( function_exists( 'wp_nonce_field' ) ) 
								wp_nonce_field( 'rs_user_login_action', 'rs_user_login_nonce' );
						?>
						<p><label for="user_login"><?php _e( 'Username', THEME_DOMAIN ); ?></label>
							<input type="text" name="user_login" id="user_login" />
						</p>
						<p><label for="user_pass"><?php _e( 'Password', THEME_DOMAIN ); ?></label>
							<input type="password" name="user_pass" id="user_pass" />
						</p>
						<p><label for="rememberme"><input type="checkbox" name="remember" id="rememberme" value="true" /> Remember Me</label></p>
						<p>
							<input type="submit" id="submit" class="button" value="Sign In" /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
							or <a href="<?php echo get_permalink( 126 ); ?>">Create new account</a>
						</p>
						<p><a href="<?php echo get_permalink( 145 ); ?>">Lost your password?</a>
					</form>
				<?php } ?>
				<div id="message" class="alert-box"></div>
			</div>
			
			<!--comment form-->
			<?php
				if( $data['rsclean_enable_pagecomment'] )
					comments_template( '', true );
			?>
		
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