<?php 

if ( ! function_exists( 'rs_posted_on' ) ) :
	function rs_posted_on() {
		printf( __( '<div class="blog-author"><span class="author vcard">af: %3$s', THEME_DOMAIN ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span></div>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', THEME_DOMAIN ), get_the_author() ),
				get_the_author()
			)
		);
	}
endif;

if ( ! function_exists( 'rs_posted_in' ) ) :
	function rs_posted_in() {
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', THEME_DOMAIN );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', THEME_DOMAIN );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', THEME_DOMAIN );
		}
		
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
endif;

function get_thumbnail($width=100, $height=100, $class='', $alttext='', $titletext='', $fullpath=false, $custom_field='')
{
	global $post, $shortname, $posts;
	
	$thumb_array['thumb'] = '';
	$thumb_array['use_timthumb'] = true;
	if ($fullpath) $thumb_array['fullpath'] = ''; //full image url for lightbox
	
	if ( function_exists('has_post_thumbnail') ) {
		if ( has_post_thumbnail() ) {
			$thumb_array['use_timthumb'] = false;
			
			$args='';
			if ($class <> '') $args['class'] = $class;
			if ($alttext <> '') $args['alt'] = $alttext;
			if ($titletext <> '') $args['title'] = $titletext;
			
			$thumb_array['thumb'] = get_the_post_thumbnail( $post->ID, array($width,$height), $args );
			
			if ($fullpath) {
				$thumb_array['fullpath'] = get_the_post_thumbnail( $post->ID );
				if ($thumb_array['fullpath'] <> '') { 
					$thumb_array['fullpath'] = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $thumb_array['fullpath'], $matches);
					$thumb_array['fullpath'] = trim($matches[1][0]);
				};
			};
		}
	};
	
	if ($thumb_array['thumb'] == '') {
		if ($custom_field == '') $thumb_array['thumb'] = get_post_meta($post->ID, 'Thumbnail', $single = true);
		else { 
			$thumb_array['thumb'] = get_post_meta($post->ID, $custom_field, $single = true);
			if ($thumb_array['thumb'] == '') $thumb_array['thumb'] = get_post_meta($post->ID, 'Thumbnail', $single = true);
		}
		
		if (($thumb_array['thumb'] == '') && ((get_option($shortname.'_grab_image')) == 'on')) $thumb_array['thumb'] = first_image();
		
		if ($fullpath) $thumb_array['fullpath'] = apply_filters('et_fullpath', $thumb_array['thumb']);
	}
			
	return $thumb_array;
}


function print_thumbnail($thumbnail = '', $use_timthumb = true, $alttext = '', $width = 100, $height = 100, $class = '', $echoout = true, $forstyle = false, $resize = true) {
	global $post;
	
	$output = '';
	$thumbnail_orig = $thumbnail;
	
	$thumbnail = rs_get_thumbnail($thumbnail);
	
	$cropPosition = get_post_meta($post->ID, 'etcrop', true) ? get_post_meta($post->ID, 'etcrop', true) : '';
	if ($cropPosition <> '') $cropPosition = '&amp;a=' . $cropPosition;
	
	if ($forstyle === false) {
	
		if ($use_timthumb === false) {
			$output = $thumbnail_orig;
		} else { 
			$output = '<img src="'.get_bloginfo('template_directory').'/timthumb.php?src='.$thumbnail.'&amp;h='. $height .'&amp;w='. $width .'&amp;zc=1&amp;q=90'.$cropPosition.'"';
		
			if ($class <> '') $output .= " class='$class' ";

			$output .= " alt='$alttext' width='$width' height='$height' />";
			
			if (!$resize) $output = $thumbnail;
		};
	
	} else {
		
		$output = $thumbnail;
		
		if ($use_timthumb === false) {
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $output, $matches);
			$output = $matches[1][0];
		} else {
			$output = get_bloginfo('template_directory').'/timthumb.php?src='.$output.'&amp;h='.$height.'&amp;w='.$width.'&amp;q=90&amp;zc=1'.$cropPosition;
		}
		
	}
	
	if ($echoout) echo $output;
	else return $output;
	
}


/**
 * @desc	Get Post thumbnail
 */
function rs_get_thumbnail( $thumbnail='' ) 
{
	global $blog_id;
	
	if( isset($blog_id) && $blog_id > 0 ) {
		$imagePath = explode('/files/', $thumbnail);
		
		if( isset($imagePath[1]) )
			$thumbnail = '/blogs.dir/' . $blog_id . '/files/' . $imagePath[1];
	}
	
	return $thumbnail;
}


/**
 * @desc	remove readmore jump
 */
function remove_more_jump_link( $link ) 
{
	$offset = strpos( $link, '#more-' );
	
	if( $offset )
		$end = strpos( $link, '"', $offset );
	
	if( $end )
		$link = substr_replace( $link, '', $offset, $end-$offset );
	
	return $link;
}


/**
 * @desc	Display site title
 */
function rs_title(){
	/*
	* Print the <title> tag based on what is being viewed.
	*/
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', THEME_DOMAIN ), max( $paged, $page ) );
}

/**
 * @desc	Truncate text
 * @param 	$text Text to truncate
 * @param 	$amount	Amount of text to display
 */
function rs_truncate( $excerpt, $amount = 100 ) {
	return substr( $excerpt, 0, strrpos(substr($excerpt, 0, $amount), ' ') );
}


/*
 * @desc 	This fetch data externally using CURL1
 * @param 	TEXT $url
 */
function curl_fetcher( $url ) {
   $ch = curl_init();
   curl_setopt( $ch, CURLOPT_URL, $url );
   curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
   curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
   
   $result = curl_exec( $ch );
   curl_close( $ch ); 
   
   return $result;
}


/*
 * @desc 	Return post or custo post ID
 * @param 	TEXT $url
 */
function rs_url_to_postid( $url ) {
    // Try the core function
    $post_id = url_to_postid( $url );
	
    if ( $post_id == 0 ) {
        
		// Try custom post types
        $cpts = get_post_types( array(
            'public'   => true,
            '_builtin' => false
        ), 'objects', 'and' );
        // Get path from URL
        $url_parts = explode( '/', trim( $url, '/' ) );
        $url_parts = array_splice( $url_parts, 3 );
        $path = implode( '/', $url_parts );
		
        // Test against each CPT's rewrite slug
        foreach ( $cpts as $cpt_name => $cpt ) {
            $cpt_slug = $cpt->rewrite['slug'];
            if ( strlen( $path ) > strlen( $cpt_slug ) && substr( $path, 0, strlen( $cpt_slug ) ) == $cpt_slug ) {
                $slug = substr( $path, strlen( $cpt_slug ) );
               
				$query = new WP_Query( array(
                    'post_type'         => $cpt_name,
                    'name'              => $slug,
                    'posts_per_page'    => 1
                ));
				
                if ( is_object( $query->post ) )
                    $post_id = $query->post->ID;
            }
        }
    }
    return $post_id;
}