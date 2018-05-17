(function($) {
	$(document).foundation();

	$('.success-stories-slider').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		variableWidth: true,
		arrows: true,
	});
/*
	$('.latest-news').owlCarousel({
	    loop:true,
	    margin:10,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:3,
	            nav:false
	        }
	    }
	});
	*/
	
})(jQuery);
