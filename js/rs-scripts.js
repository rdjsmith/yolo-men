/**
 * @desc	This contains all scripts use in site themes
 */

jQuery(document).ready(function($) {	

	// Add heading in billing page
	$("p#billing_inches_centimeters_field").before("<h3>Measurements</h3>");
	$("p#billing_standard_measurement_field").append("<small style='font-size: 90%;'>please see our standard measurement chart on resources page</small>");

	// Scroll Top
	$('div.scroll-top').click(function() {
		$('html, body').animate({ scrollTop:0 }, 600);
		
		return false;
	});

	
	// Blog Hover
	$(".blogMediaWrapper img, .social-sharing img").hover(function(){
		$(this).animate({ opacity: 0.60 }, 150);
	}, function(){
		$(this).animate({ opacity: 1 }, 150);
	});


	//  Responsive Menu
	$(".mobile-menu select.menu-pages").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	

	$('#map-container').storeLocator({
		autoGeocode: false
	});

	
	// Accordion
	var gdl_accordion = $('ul.rs-accordion');
	gdl_accordion.find('li').not('.active').each(function(){
		$(this).children('.accordion-content').css('display', 'none');
	});

	gdl_accordion.find('li').click(function(){
		if( !$(this).hasClass('active') ){
			$(this).addClass('active').children('.accordion-content').slideDown();
			$(this).siblings('li').removeClass('active').children('.accordion-content').slideUp();
		}
	});

	
	// Toggle Box
	var gdl_toggle_box = $('ul.rs-toggle-box');

	gdl_toggle_box.find('li').not('.active').each(function(){
		$(this).children('.toggle-box-content').css('display', 'none');
	});

	gdl_toggle_box.find('li').click(function(){
		if( $(this).hasClass('active') ){
			$(this).removeClass('active').children('.toggle-box-content').slideUp();
		} else {
			$(this).addClass('active').children('.toggle-box-content').slideDown();
		}
	});



	// Tab
	var gdl_tab = $('div.rs-tab');

	gdl_tab.find('li a').click(function(e){
		e.preventDefault();

		
		if( $(this).hasClass('active') ) 
			return;
		
		var data_tab = $(this).attr('data-tab'),
			tab_title = $(this).parents('ul.rs-tab-title'),
			tab_content = tab_title.siblings('ul.rs-tab-content');


		// tab title
		tab_title.find('a.active').removeClass('active');
		$(this).addClass('active');

		
		// tab content
		tab_content.find('li.active').removeClass('active').css('display', 'none');
		tab_content.find('li[data-tab="' + data_tab + '"]').fadeIn().addClass('active');
	});  


	// Sliders
	$(".rslides").responsiveSlides({
		auto: true,             // Boolean: Animate automatically, true or false
		speed: 1000,            // Integer: Speed of the transition, in milliseconds
		timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
		pager: true,            // Boolean: Show pager, true or false
		nav: true,             // Boolean: Show navigation, true or false
		random: false,          // Boolean: Randomize the order of the slides, true or false
		pause: false,           // Boolean: Pause on hover, true or false
		pauseControls: true,    // Boolean: Pause when hovering controls, true or false
		prevText: "Previous",   // String: Text for the "previous" button
		nextText: "Next",       // String: Text for the "next" button
		maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
		controls: "",           // Selector: Where controls should be appended to, default is after the 'ul'
		namespace: "rslides",   // String: change the default namespace used
	});

	  
	// Testimonial sliders
	$('#testimonials').cycle({
		fx:     'fade', 
		speed:  'slow', 
		timeout: 2000, 
		next:   '#next', 
		prev:   '#prev',
		after:	onAfter
	});

	
	function onAfter( curr, next, opts, fwd )
	{
		var index = opts.currSlide;
		$('#prev')[index == 0 ? 'hide' : 'show']();
		$('#next')[index == opts.slideCount - 1 ? 'hide' : 'show']();
		
		//get the height of the current slide
		var $ht = $(this).height();

		
		//set the container's height to that of the current slide
		$(this).parent().animate({height: $ht}, 500);
	}

	
	// make the product featuredImageFrame floated
	var s = $("div#featureImageFrame"),
		pos = s.position();
	
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
		screen_width = $(document).width();
		
		if( screen_width > 768 )
			screen_top = 420;
		else
			screen_top = 520;
		
		//if ( windowpos >= pos.top )
		if ( parseFloat( windowpos ) >= screen_top )
			s.addClass("stickMe");
		else
			s.removeClass("stickMe");

    });

});

