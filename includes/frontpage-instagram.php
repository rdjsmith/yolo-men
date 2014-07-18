<?php
	global $data;
	
	$username 		= $data['rsclean_instagram_username'];
	$client_id 		= $data['rsclean_instagram_client_id'];
	$access_token 	= $data['rsclean_instagram_access_token'];
	$count 			= $data['rsclean_instagram_count'];
	$display_size 	= $data['rsclean_instagram_display_size'];
	
	// display images on specific user only
	$result = curl_fetcher( "https://api.instagram.com/v1/users/$client_id/media/recent/?access_token=$access_token&count=$count" );
	$result = json_decode( $result );
	
	if( $result->data ) {
		foreach( $result->data as $post ) {
			//print_r( $post );
			
			$img 		= $post->images->{$display_size};
			$item_url 	= $post->link;  
			$caption 	= $post->caption->text;
			
			?>
				<div class="three mobile-two columns">
					<a href="<?php echo $item_url; ?>" target="_blank">
						<img src="<?php echo $img->url; ?>" alt="<?php echo $caption; ?>" />
					</a>
				</div>
			<?php
		}
	} else {
		var_dump( $result->data );
	}
?>