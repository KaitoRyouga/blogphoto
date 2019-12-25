jQuery(document).ready(function($) {
	$('.menu li').hover(function() {
		$(this).find('ul:first').slideDown(500);
	}, function() {
		$(this).find('ul:first').hide(300);
	});
	$('.back-to-top').click(function(event) {
		$('html,body').animate({scrollTop:0}, 500);
	});
	$('.concept-layout-detail').hover(function() {
		$(this).find('.icobox:first').addClass('appear');
	}, function() {
		$(this).find('.icobox:first').removeClass('appear');
	});
	$('.search-box').click(function(event) {
		$('.table-search-box').addClass('appear1');
		$('.nenmo').addClass('appear1');
	});
	$('.table-search-box span').click(function(event) {
		$('.table-search-box').removeClass('appear1');
		$('.nenmo').removeClass('appear1');
	});
	$('.nenmo').click(function(event) {
		$('.table-search-box').removeClass('appear1');
		$('.nenmo').removeClass('appear1');
	});
});