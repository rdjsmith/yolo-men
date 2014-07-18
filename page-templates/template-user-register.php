<?php
/*
Template Name: User Registration
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

			<div id="rs_user_registration_wrapper">
				<form method="post" id="rs_user_registration">
					<?php
						if ( function_exists( 'wp_nonce_field' ) ) 
							wp_nonce_field( 'rs_user_registration_action', 'rs_user_registration_nonce' );
					?>
					<h3>Don't have an account? <strong class="colored-text">Create one now</strong></h3>
					
					<p><label for="last_name"><?php _e( 'Last Name', RS_DOMAIN ); ?></label>
						<input type="text" value="" name="last_name" id="last_name" />
					</p>
					<p><label for="first_name"><?php _e( 'First Name', RS_DOMAIN ); ?></label>
						<input type="text" value="" name="first_name" id="first_name" />
					</p>
					<p><label for="email"><?php _e( 'Email', RS_DOMAIN ); ?></label>
						<input type="email" value="" name="email" id="email" />
					</p>
					<p><label for="username"><?php _e( 'Username', RS_DOMAIN ); ?></label>
						<input type="text" value="" name="username" id="username" />
					</p>
					<p><label for="password"><?php _e( 'Password', RS_DOMAIN ); ?></label>
						<input type="password" value="" name="pwd1" id="pwd1" />
					</p>
					<p><label for="password_again"><?php _e( 'Password again', RS_DOMAIN ); ?></label>
						<input type="password" value="" name="pwd2" id="pwd2" />
					</p>
					<p>
						<input type="submit" id="submit" class="button" value="Sign Up" /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
					</p>
					
					<div id="message" class="alert-box"></div>
				</form>
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