<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php global $woo_options, $woocommerce, $product, $data; ?>
	
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php rs_title(); ?></title>
	<?php if( $data['rsclean_favicon'] ) { ?>
		<link rel="shortcut icon" type="image/png" href="<?php echo $data['rsclean_favicon']; ?>" />
	<?php } ?>
	
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<!--link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,700' rel='stylesheet' type='text/css'>
	
	<script>
		document.documentElement.className = 'js';
	</script>
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/ie8-grid-foundation.css" />
	<![endif]-->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
				
		<header id="header">
			<div class="row">
				
				<div class="four columns">
					<hgroup>
						<?php
							$default_logo = get_stylesheet_directory_uri() . '/images/logo.png';
							$new_logo = empty( $data['rsclean_logo'] ) ? $default_logo : $data['rsclean_logo']; 
						?>
						<h1 class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>">
							<img src="<?php echo $new_logo; ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" />
						</a></h1>
						<h2 class="slogan"><?php bloginfo('description'); ?></h2>
					</hgroup>
				</div>
				
				<div class="eight columns">
					<div class="right">
						
						<section class="cartWrapper">
							<div class="textRight">
								<ul class="no-bullet">
									<li><a href="<?php echo get_permalink( 7 ); ?>"><i class="fa fa-user"></i> Login</a></li>
									<li>
										<?php
											/*
											Display number of items in cart and total
											*/
											
											if( '0' == $woocommerce->cart->get_cart_total() )
												$cart_total = '0';
											else
												$cart_total = $woocommerce->cart->get_cart_total();
												
											echo '
												<a href="'. $woocommerce->cart->get_cart_url() .'" title="View your shopping cart" class="cart-parent">
													<span class="cartContents"><i class="fa fa-shopping-cart"></i> Cart <span class="cartTotal">'. $woocommerce->cart->cart_contents_count .'</span></span>
												</a>
												<span class="separator">|</span>
												<a href="'. $woocommerce->cart->get_cart_url() .'" title="View your shopping cart" class="cart-parent">'. $cart_total .'</a>
											';
										?>
									</li>
								</ul>
								<div class="translationWrapper">
									<!--[if !IE]> --> <div class="notIE"> <!-- <![endif]-->
									<label />
									<?php
										echo do_shortcode( '[currency_switcher]' );
										// do_action('icl_language_selector');
									?>
									<!--[if !IE]> --></div> <!-- <![endif]-->
								</div>
                                                            <div>
                                                                <h4 id="mainemail"><a href="contact">hello@yolomen.com</a></h4>
                                                                <div class="socialSharing">
                                                                    <?php if( $data['rsclean_facebook_username'] ) { ?>
                                                                        <a href="http://facebook.com/<?php echo $data['rsclean_facebook_username']; ?>" target="_blank" class="facebook" title="Facebook">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/facebook-icon.png" alt="Facebook" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_twitter_username'] ) { ?>
                                                                        <a href="http://twitter.com/<?php echo $data['rsclean_twitter_username']; ?>" target="_blank" class="twitter" title="Twitter">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/twitter-icon.png" alt="Twitter" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_instagram_username'] ) { ?>
                                                                        <a href="http://instagram.com/<?php echo $data['rsclean_instagram_username']; ?>" target="_blank" class="instagram" title="Instagram">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/instagram-icon.png" alt="Instagram" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_pinterest_username'] ) { ?>
                                                                        <a href="http://pinterest.com/<?php echo $data['rsclean_pinterest_username']; ?>" target="_blank" class="pinterest" title="Pinterest">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/pinterest-icon.png" alt="Pinterest" />
                                                                        </a>
                                                                    <?php } ?>


                                                                    <?php if( $data['rsclean_googleplus_url'] ) { ?>
                                                                        <a href="<?php echo $data['rsclean_googleplus_url']; ?>" target="_blank" class="gplus" title="Google+">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/g-plus-icon.png" alt="Google Plus" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_flickr_username'] ) { ?>
                                                                        <a href="http://flickr.com/people/<?php echo $data['rsclean_flickr_username']; ?>" target="_blank" class="flickr" title="Flickr">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/flickr-icon.png" alt="Flickr" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_youtube_username'] ) { ?>
                                                                        <a href="http://youtube.com/user/<?php echo $data['rsclean_youtube_username']; ?>" target="_blank" class="youtube" title="Youtube">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/youtube-icon.png" alt="Youtube" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_vimeo_username'] ) { ?>
                                                                        <a href="http://vimeo.com/<?php echo $data['rsclean_vimeo_username']; ?>" target="_blank" class="vimeo" title="Vimeo">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/vimeo-icon.png" alt="Vimeo" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_digg_username'] ) { ?>
                                                                        <a href="http://digg.com/<<?php echo $data['rsclean_digg_username']; ?>" target="_blank" class="digg" title="Digg">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/digg-icon.png" alt="Digg" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_dribble_username'] ) { ?>
                                                                        <a href="http://dribbble.com/<?php echo $data['rsclean_dribble_username']; ?>" target="_blank" class="dribble" title="Dribble">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/dribble-icon.png" alt="Dribble" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_linkedin_username'] ) { ?>
                                                                        <a href="<?php echo $data['rsclean_linkedin_username']; ?>" target="_blank" class="linkedin" title="Linkedin">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/linkedin-icon.png" alt="Linkedin" />
                                                                        </a>
                                                                    <?php } ?>

                                                                    <?php if( $data['rsclean_tumblr_username'] ) { ?>
                                                                        <a href="<?php echo $data['rsclean_tumblr_username']; ?>" target="_blank" class="thumblr" title="Tumblr">
                                                                                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/small/tumblr-icon.png" alt="Tumblr" />
                                                                        </a>
                                                                    <?php } ?>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                            </div>
							</div>
						</section>
						
						<section class="sloganHolderWrapper">
							<h2 class="sloganCaption">
								<?php bloginfo('description'); ?>
								<!--img src="<?php echo get_bloginfo('template_directory'); ?>/images/colour.png" alt="Colour" class="sloganImageColour" /-->
							</h2>
						</section>	
					
					</div>
				</div>
				
			</div>
		</header>
		
		<nav id="navigation" role="menu">
			<div class="row">
				<div class="twelve columns">
					
					<div class="menuWrapper">
						<div class="textCenter">
							<div class="show-for-small mobile-menu">
								<?php
									rs_dropdown_menu( array(
										'dropdown_title' 	=> __( 'Select a Page', THEME_DOMAIN ),
										'indent_string' 	=> '- ', 
										'indent_after' 		=> '', 
										'theme_location'	=> 'mobile-menu'
									) );
								?>
							</div>
							<div class="hide-for-small mainMenu">
								<?php
									$menu_class = 'primaryMenu sf-menu no-bullet';
									$main_nav = '';
										
									if ( function_exists('wp_nav_menu') ) {
										$main_nav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menu_class, 'echo' => false ) );
									};
									if ($main_nav == '') : ?>
										<ul class="<?php echo $menu_class; ?>">	
											<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
										</ul> <?php
									else :
										echo( $main_nav );
									endif; 
								?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</nav>
		
		<!--start main content-->
		<main role="main" id="main">
			
			<?php if( is_product() ) { ?>
				<div class="singleProductBanner">
					<div class="row">
						<div class="four columns">
							<div class="singleProductBannerItem">
								<div class="textCenter">
									<h3 class="bannerTitle"><?php echo $data['rsclean_first_product_banner']; ?></h3>
								</div>
							</div>
						</div>
						<div class="four columns">
							<div class="singleProductBannerItem">
								<div class="textCenter">
									<h3 class="bannerTitle"><?php echo $data['rsclean_second_product_banner']; ?></h3>
								</div>
							</div>
						</div>
						<div class="four columns">
							<div class="singleProductBannerItem">
								<div class="textCenter">
									<h3 class="bannerTitle"><?php echo $data['rsclean_third_product_banner']; ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			