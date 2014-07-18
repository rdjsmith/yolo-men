<?php
/*
Template Name: User Reset
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
			
			   <div id="rs_user_reset_wrapper">
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
						 <form method="post" id="rs_user_reset">
							  <?php
								   if ( function_exists( 'wp_nonce_field' ) ) 
										wp_nonce_field( 'rs_user_reset_action', 'rs_user_reset_nonce' );
							  ?>
							  <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
							  <p><label for="email">Username or E-mail:</label>
								 <input type="email" name="email" id="email" /></p>
							  <p>
								 <input type="submit" id="submit" class="button" value="Get New Password" />
								 <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" id="preloader" alt="Preloader" />
							  </p>						
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