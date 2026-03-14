jQuery(document).ready(function ($) {
  $('.wl-row').addClass('owl-carousel');
  jQuery('.owl-carousel.wl-row').owlCarousel({
    loop: true,
    margin: 10,
    items: 3.7,
    nav: false,
    dots: false,
    rtl: false,
    speed: 200,
    responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1.5
    },
    992: { 
      items:2.5
    },
    1200: { 
      items: 2.7
    },
    1500: { 
      items: 3.7
    }
  },
    autoplay: true,
  });
});

jQuery(document).ready(function ($) {
  var owl = $(".banner-section-slider.owl-carousel");

  owl.owlCarousel({
    loop: true,
    items: 1,
    margin: 15,
    speed: 200,
    nav: false,
    dots: false,
    rtl: false,
    autoplay: true,
  });

  // Custom Navigation
  $(".team-next").click(function () {
    owl.trigger("next.owl.carousel");
  });

  $(".team-prev").click(function () {
    owl.trigger("prev.owl.carousel");
  });
});