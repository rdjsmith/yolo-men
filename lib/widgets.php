<?php
	
add_action( 'widgets_init', 'rs_load_widgets' );
/*
 * register thumbnail list widget
 */
function rs_load_widgets(){
	include_once( TEMPLATEPATH . '/lib/rs-tabs/rs-tabs.php' );
	include_once( TEMPLATEPATH . '/lib/rs-recent-posts/rs-recent-posts.php' );
	include_once( TEMPLATEPATH . '/lib/rs-twitter/rs-twitter.php' );
	include_once( TEMPLATEPATH . '/lib/rs-contact-widget/rs-contact-widget.php' );
	include_once( TEMPLATEPATH . '/lib/rs-most-viewed/rs-most-viewed.php' );
	include_once( TEMPLATEPATH . '/lib/rs-category-widget/rs-category-widget.php' );
	include_once( TEMPLATEPATH . '/lib/rs-recent-projects/rs-recent-projects.php' );
	
	register_widget( 'RS_Tabs' );
	register_widget( 'RS_Recent_Posts' );
	register_widget( 'RS_Twitter' );
	register_widget( 'RS_Contact' );
	register_widget( 'RS_Most_Viewed' );
	register_widget( 'RS_Category_Feeds_Widget' );
	register_widget( 'RS_Recent_Projects' );
}

?>