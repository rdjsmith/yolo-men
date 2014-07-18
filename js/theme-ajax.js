/*
 * @author Ryan Sutana
 * @description Pass all datas requested through wp-ajax
 * since v 1.0
 */

jQuery(document).ready(function($) {
	
	$("form#rs_contact, #rs_contact_widget").submit(function(){
		var submit = $("#rs_contact_wrapper #submit"),
			preloader = $("#rs_contact_wrapper #preloader"),
			message	= $("#rs_contact_wrapper #message"),
			contents = {
				action: 'theme_contact',
				nonce: 	this.rs_contact_nonce.value,
				name:	this.name.value,
				email:	this.email.value,
				message:this.message.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			preloader.css({'visibility':'hidden'});
			
			// display return data
			message.html( data );
		});
		
		return false;
	});
	
	// for user registration form
	$("form#rs_user_registration").submit(function(){
		var submit = $("div#rs_user_registration_wrapper #submit"),
			preloader = $("div#rs_user_registration_wrapper #preloader"),
			message	= $("div#rs_user_registration_wrapper #message"),
			contents = {
				action: 	'user_registration',
				nonce: 		this.rs_user_registration_nonce.value,
				last_name:	this.last_name.value,
				first_name:	this.first_name.value,
				email:		this.email.value,
				username:	this.username.value,
				pwd1:		this.pwd1.value,
				pwd2:		this.pwd2.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			// hide pre-loader
			preloader.css({'visibility':'hidden'});
			
			// check response data
			if( 1 == data ) {
				// redirect to home page
				window.location = theme_ajax.site_url;
			} else {
				// display return data
				message.html( data );
			}
		});
		
		return false;
	});
	
	// for user login form
	$("form#rs_user_login").submit(function(){
		var submit = $("div#rs_user_login_wrapper #submit"),
			preloader = $("div#rs_user_login_wrapper #preloader"),
			message	= $("div#rs_user_login_wrapper #message"),
			contents = {
				action: 	'user_login',
				nonce: 		this.rs_user_login_nonce.value,
				user_login:	this.log.value,
				user_pass:	this.pwd.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			// hide pre-loader
			preloader.css({'visibility':'hidden'});
			
			// check response data
			if( 1 == data ) {
				// redirect to home page
				window.location = theme_ajax.site_url;
			} else {
				// display return data
				message.html( data );
			}
		});
		
		return false;
	});
	
	
	var ul_products = $( 'div.productsLists' ),
		li_product = $( 'li.product', ul_products ),
		a_product = $( 'a', li_product ),
		featureImageFrame = $( 'div#featureImageFrame' );
	
	a_product.each(function( key, value ){
		
		$(this).mouseover(function( event ) {
			
			var a_product_href = $(this).attr( 'href' );
			
			contents = {
				action: 		'product_ajax',
				product_href:	a_product_href
			};
			
			featureImageFrame.html( '<p>Loading...</p>' );

			// post product item url
			$.post( theme_ajax.url, contents, function( data ){
			
				featureImageFrame.html( data.featured_image );
				
				//console.log( data.product_id );
				//console.log( data.featured_image );
				
			}, "json");
			
			event.preventDefault();
		
		});
	});
	
});