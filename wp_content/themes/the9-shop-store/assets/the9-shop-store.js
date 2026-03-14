;(function($) {
'use strict'
	// Dom Ready
	var the9_preloader_init = function(action, element) {
	    if (action === 'show') {
	        $('body').addClass('overlay--enabled');
	    }

	    var runLoader = function() {
	        if ($(element).length) {
	            $(element).find('.preloader-animation').remove();
	            $(element).find('.loader').addClass('loaded');
	            $('body').removeClass('overlay--enabled');

	            setTimeout(function() {
	                $(element).remove();
	            }, 1000);
	        }
	    };

	    if (document.readyState === 'complete') {
	        runLoader(); // already loaded
	    } else {
	        $(window).one('load', runLoader); // wait for load, run once
	    }
	};
	$(function() {
		
	if( $('#the9_preloader').length ){
		the9_preloader_init('show', '#the9_preloader');
	}
	if( $('.owlGallery,.img-box ul.blocks-gallery-grid').length ){
		$(".owlGallery,.img-box ul.blocks-gallery-grid").owlCarousel({
			stagePadding: 0,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 20,
			nav: false,
			dots: false,
			smartSpeed: 1000,
			rtl: ( $("body.rtl").length ) ? true : false, 
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	}
	
	if ($('button.btn-mega').length) {
		$('.cat-menu-wrap').on('focusin', function() {
		  $(this).find('.sub-menu').addClass('focus');
		});

		$('.cat-menu-wrap').on('focusout', function() {
		  $(this).find('.sub-menu').removeClass('focus');
		});
	}
	});
})(jQuery);