/*
 * Contain all JS script
 */
 
jQuery(document).ready(function($){
	var remove_copy_field = '<a href="#" onClick="$(this).parent().slideUp(function(){$(this).remove()}); return false">remove</a>';
	
	$('a#copy_review').relCopy({ limit: 5, append: remove_copy_field });
});