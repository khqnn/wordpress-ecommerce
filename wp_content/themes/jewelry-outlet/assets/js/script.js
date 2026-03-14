/* ===============================================
  OPEN CLOSE Menu
============================================= */

function jewelry_outlet_open_menu() {
  jQuery('button.menu-toggle').addClass('close-panal');
  setTimeout(function(){
    jQuery('nav#main-menu').show();
  }, 100);

  return false;
}
jQuery( "button.menu-toggle").on("click", jewelry_outlet_open_menu);

function jewelry_outlet_close_menu() {
  jQuery('button.close-menu').removeClass('close-panal');
  jQuery('nav#main-menu').hide();
}

jQuery( "button.close-menu").on("click", jewelry_outlet_close_menu);

/* ===============================================
  TRAP TAB FOCUS ON MODAL MENU
============================================= */

jQuery('button.close-menu').on('keydown', function (e) {
  if (jQuery("this:focus") && !!e.shiftKey && e.keyCode === 9) {
  } else if (jQuery("this:focus") && (e.which === 9)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.menu li a:first').focus()
  }
});

jQuery('.menu li a:first').on('keydown', function (event) {
  if (jQuery("this:focus") && !!event.shiftKey && event.keyCode === 9) {
    event.preventDefault();
    jQuery(this).blur();
    jQuery('button.close-menu').focus()
  }
});

jQuery('#main-menu ul:first li:first a').on('keydown', function (event) {
  if (event.shiftKey && event.keyCode == 9) {
    event.preventDefault();
    jQuery(this).blur();
    jQuery('button.close-menu').focus();
  }
})

jQuery(document).ready(function() {
  window.addEventListener('load', (event) => {
      jQuery(".loader").delay(2000).fadeOut("slow");
  });
});

jQuery('a[href="#tobottom"]').click(function () {
  jQuery('html, body').animate({scrollTop: 0}, 'slow');
  return false;
});
(function( $ ) {
  $(window).scroll(function(){
      var sticky = $('.sticky-header'),
      scroll = $(window).scrollTop();
      if (scroll >= 100) sticky.addClass('fixed-header');
      else sticky.removeClass('fixed-header');
    });
  })( jQuery );

  jQuery(document).ready(function() {
    window.addEventListener('load', (event) => {
        jQuery(".loader").delay(2000).fadeOut("slow");
      });
  })
/* ===============================================
  Scroll Top //
============================================= */

jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 100) {
      jQuery('.scroll-up').fadeIn();
  } else {
      jQuery('.scroll-up').fadeOut();
  }
});

jQuery('a[href="#tobottom"]').click(function () {
  jQuery('html, body').animate({scrollTop: 0}, 'slow');
  return false;
});
/* ===============================================
  Category button
============================================= */
jQuery(document).ready(function(){
  jQuery(".product-cat").hide();
  jQuery("button.product-btn").click(function(){
    jQuery(".product-cat").toggle();
	    });
	});

/* ===============================================
  Custom Cursor
============================================= */

const jewelry_outlet_customCursor = {
  init: function () {
    this.jewelry_outlet_customCursor();
  },
  isVariableDefined: function (el) {
    return typeof el !== "undefined" && el !== null;
  },
  select: function (selectors) {
    return document.querySelector(selectors);
  },
  selectAll: function (selectors) {
    return document.querySelectorAll(selectors);
  },
  jewelry_outlet_customCursor: function () {
    const jewelry_outlet_cursorDot = this.select(".cursor-point");
    const jewelry_outlet_cursorOutline = this.select(".cursor-point-outline");
    if (this.isVariableDefined(jewelry_outlet_cursorDot) && this.isVariableDefined(jewelry_outlet_cursorOutline)) {
      const cursor = {
        delay: 8,
        _x: 0,
        _y: 0,
        endX: window.innerWidth / 2,
        endY: window.innerHeight / 2,
        cursorVisible: true,
        cursorEnlarged: false,
        $dot: jewelry_outlet_cursorDot,
        $outline: jewelry_outlet_cursorOutline,

        init: function () {
          this.dotSize = this.$dot.offsetWidth;
          this.outlineSize = this.$outline.offsetWidth;
          this.setupEventListeners();
          this.animateDotOutline();
        },

        updateCursor: function (e) {
          this.cursorVisible = true;
          this.toggleCursorVisibility();
          this.endX = e.clientX;
          this.endY = e.clientY;
          this.$dot.style.top = `${this.endY}px`;
          this.$dot.style.left = `${this.endX}px`;
        },

        setupEventListeners: function () {
          window.addEventListener("load", () => {
            this.cursorEnlarged = false;
            this.toggleCursorSize();
          });

          jewelry_outlet_customCursor.selectAll("a, button").forEach((el) => {
            el.addEventListener("mouseover", () => {
              this.cursorEnlarged = true;
              this.toggleCursorSize();
            });
            el.addEventListener("mouseout", () => {
              this.cursorEnlarged = false;
              this.toggleCursorSize();
            });
          });

          document.addEventListener("mousedown", () => {
            this.cursorEnlarged = true;
            this.toggleCursorSize();
          });
          document.addEventListener("mouseup", () => {
            this.cursorEnlarged = false;
            this.toggleCursorSize();
          });

          document.addEventListener("mousemove", (e) => {
            this.updateCursor(e);
          });

          document.addEventListener("mouseenter", () => {
            this.cursorVisible = true;
            this.toggleCursorVisibility();
            this.$dot.style.opacity = 1;
            this.$outline.style.opacity = 1;
          });

          document.addEventListener("mouseleave", () => {
            this.cursorVisible = false;
            this.toggleCursorVisibility();
            this.$dot.style.opacity = 0;
            this.$outline.style.opacity = 0;
          });
        },

        animateDotOutline: function () {
          this._x += (this.endX - this._x) / this.delay;
          this._y += (this.endY - this._y) / this.delay;
          this.$outline.style.top = `${this._y}px`;
          this.$outline.style.left = `${this._x}px`;

          requestAnimationFrame(this.animateDotOutline.bind(this));
        },

        toggleCursorSize: function () {
          if (this.cursorEnlarged) {
            this.$dot.style.transform = "translate(-50%, -50%) scale(0.75)";
            this.$outline.style.transform = "translate(-50%, -50%) scale(1.6)";
          } else {
            this.$dot.style.transform = "translate(-50%, -50%) scale(1)";
            this.$outline.style.transform = "translate(-50%, -50%) scale(1)";
          }
        },

        toggleCursorVisibility: function () {
          if (this.cursorVisible) {
            this.$dot.style.opacity = 1;
            this.$outline.style.opacity = 1;
          } else {
            this.$dot.style.opacity = 0;
            this.$outline.style.opacity = 0;
          }
        },
      };
      cursor.init();
    }
  },
};
jewelry_outlet_customCursor.init();

/* ===============================================
  Progress Bar
============================================= */
const jewelry_outlet_progressBar = {
  init: function () {
      let jewelry_outlet_progressBarDiv = document.getElementById("elemento-progress-bar");

      if (jewelry_outlet_progressBarDiv) {
          let jewelry_outlet_body = document.body;
          let jewelry_outlet_rootElement = document.documentElement;

          window.addEventListener("scroll", function (event) {
              let jewelry_outlet_winScroll = jewelry_outlet_body.scrollTop || jewelry_outlet_rootElement.scrollTop;
              let jewelry_outlet_height =
              jewelry_outlet_rootElement.scrollHeight - jewelry_outlet_rootElement.clientHeight;
              let jewelry_outlet_scrolled = (jewelry_outlet_winScroll / jewelry_outlet_height) * 100;
              jewelry_outlet_progressBarDiv.style.width = jewelry_outlet_scrolled + "%";
          });
      }
  },
};
jewelry_outlet_progressBar.init();

/* ===============================================
   sticky copyright
============================================= */

window.addEventListener('scroll', function() {
  var jewelry_outlet_footer = document.querySelector('.sticky-copyright');
  if (!jewelry_outlet_footer) return; 

  var jewelry_outlet_scrollTop = window.scrollY || document.documentElement.jewelry_outlet_scrollTop;

  if (jewelry_outlet_scrollTop >= 100) {
    jewelry_outlet_footer.classList.add('active-sticky');
  }
});
