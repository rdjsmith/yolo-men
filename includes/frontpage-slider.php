<div class="row">
	<div class="twelve columns">
		<?php
		global $data;
		
		if( $data['rsclean_enable_slider'] ) { ?>
		
			<ul class="rslides">
				<?php
					$sliders = $data['rsclean_homepage_sliders'];
					
					foreach( $sliders as $slider ) 
					{
						?>
						<li>
							<div class="sliderContent">
								<img src="<?php echo $slider['url']; ?>" alt="<?php echo esc_attr( $slider['title'] ); ?>" class="sliderImage" />
								
								<div class="sliderDescription">
									<h2 class="sliderTitle">
										<?php echo $slider['title']; ?>
									</h2>
									<?php echo wpautop( $slider['description'] ); ?>
									
									<?php if( $slider['link'] ) { ?>
										<a href="<?php echo $slider['link']; ?>" class="button">Read More</a>
									<?php } ?>
								</div>
							</div>
						</li>
						<?php
					}
				?>
			</ul>
		
		<?php } ?>
	</div>
</div>