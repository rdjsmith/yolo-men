<?php
/*
Template Name: Home Page No Philosophy
*/
?>

<?php get_header();

	global $data;
?>
	
	<section class="sliderWrapper">
		<?php get_template_part( 'includes/frontpage-slider' ); ?>
	</section>
	
	<section class="collectionWrapper">
		<?php get_template_part( 'includes/frontpage-latest' ); ?>
	</section>

	<section class="StartShoppingWrapper">
                <?php get_template_part( 'includes/frontpage-startshopping' ); ?>
	</section>
	
	<section class="blogWrapper">
		<div class="row">
			<div class="twelve column">
				<h2 class="pageTitle">In the World of Yolomen</h2>
			</div>
		</div>
		
		<?php get_template_part( 'includes/frontpage-latest-blog-posts' ); ?>
	</section>
	
	<section class="testimonialWrapper">
		<div class="row">
			<div class="twelve column">
				<h2 class="pageTitle">Testimonials</h2>
			</div>
		</div>
		
		<?php get_template_part( 'includes/frontpage-testimonial' ); ?>
	</section>
	
	<section class="resInstaWrapper">
		<div class="row">
			<div class="eight columns">
				
				<div class="row">
					<div class="twelve column">
						<h2 class="pageTitle">Instagram <a href="http://instagram.com/<?php echo $data['rsclean_instagram_username']; ?>" target="_blank">@yolomenclothing</a></h2>
					</div>
				</div>
				
				<section class="instaWrapper">
					<div class="row">
						<?php get_template_part( 'includes/frontpage-instagram' ); ?>
					</div>
				</section>
				
			</div>
			<div class="four columns">
				<div class="row">
					<div class="twelve column">
						<h2 class="pageTitle">Resources</h2>
					</div>
				</div>
				
				<section class="resourceImageWrapper">
					<figure>
						<a href="<?php echo get_permalink( 69 ); ?>">
							<img src="<?php echo $data['rsclean_resource_image']; ?>" alt="Resource" />
						</a>
					</figure>
				</section>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>