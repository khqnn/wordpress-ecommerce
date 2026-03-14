( function( $ ) {
	"use strict";

	jQuery(document).ready(function($){

	$('#primary-menu li.menu-item').addClass('menuhide');
	$('#primary-menu li.menu-item').on('click', function(){
	$(this).removeClass('menuhide');
	});

	$('.mini-toggle').on('click', function(){
	   $(this).parent().toggleClass('menushow');
	});
	$('.single-product input.qty').each(function () {
	  $(this).number();
	});

	$("#besearch").on('click', function(e){
			e.preventDefault();
          $('#bspopup').addClass('popup-box-on');
            });
          
            $("#removeClass").click(function () {
          $('#bspopup').removeClass('popup-box-on');
            });

	// Shop by Department Dropdown Toggle
	$('.department-toggle').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$(this).closest('.wowmart-department-menu').toggleClass('active');
	});

	// Close department dropdown when clicking outside
	$(document).on('click', function(e) {
		if (!$(e.target).closest('.wowmart-department-menu').length) {
			$('.wowmart-department-menu').removeClass('active');
		}
	});

	// Close on ESC key
	$(document).on('keydown', function(e) {
		if (e.key === 'Escape' || e.keyCode === 27) {
			$('.wowmart-department-menu').removeClass('active');
			$('.filter-group').removeClass('active');
		}
	});

	// Filter Bar Toggle
	$('.filter-dropdown-toggle').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		var $parent = $(this).closest('.filter-group');
		$('.filter-group').not($parent).removeClass('active');
		$parent.toggleClass('active');
	});

	// Close filter dropdowns when clicking outside
	$(document).on('click', function(e) {
		if (!$(e.target).closest('.filter-group').length) {
			$('.filter-group').removeClass('active');
		}
	});

	// Handle filter changes
	$('.filter-option input').on('change', function(){
		applyFilters();
	});

	// Reset filters
	$('.reset-filters-btn').on('click', function(){
		window.location.href = window.location.pathname;
	});

	// Sort change
	$('.sort-dropdown select.orderby').on('change', function(){
		applyFilters();
	});

	// Function to apply filters
	function applyFilters() {
		var url = new URL(window.location.href);
		var params = new URLSearchParams(url.search);
		
		// Get selected categories
		var categories = [];
		$('input[name="product_cat"]:checked').each(function(){
			categories.push($(this).val());
		});
		if(categories.length > 0) {
			params.set('product_cat', categories.join(','));
		} else {
			params.delete('product_cat');
		}
		
		// Get selected colors
		var colors = [];
		$('input[name="filter_color"]:checked').each(function(){
			colors.push($(this).val());
		});
		if(colors.length > 0) {
			params.set('filter_color', colors.join(','));
		} else {
			params.delete('filter_color');
		}
		
		// Get stock filter
		var stock = $('input[name="filter_stock"]:checked').val();
		if(stock) {
			params.set('filter_stock', stock);
		} else {
			params.delete('filter_stock');
		}
		
		// Get sort order
		var orderby = $('select.orderby').val();
		if(orderby && orderby !== 'date') {
			params.set('orderby', orderby);
		} else {
			// Default is 'date' (NEWEST), so we can include it or omit it
			params.set('orderby', orderby);
		}
		
		// Redirect with new params
		window.location.href = url.pathname + '?' + params.toString();
	}

	}); // document ready

	 $.fn.shopToolKitAccessibleDropDown = function () {
			    var el = $(this);

			    /* Make dropdown menus keyboard accessible */

			    $("a", el).focus(function() {
			        $(this).parents("li").addClass("befocus");
			    }).blur(function() {
			        $(this).parents("li").removeClass("befocus");
			    });
			}

	$.fn.shopToolKitAccessibleDropDown1 = function () {
		 var el = $(this);

			    /* Make dropdown menus keyboard accessible */

			  $("button.mini-toggle", el).focus(function() {
			        $(this).parents("li").addClass("befocus");
			  })/*.blur(function() {
			        $(this).parents("li").removeClass("befocus");
			  });*/
	}
	 $("#primary-menu").shopToolKitAccessibleDropDown();
	
}( jQuery ) );
