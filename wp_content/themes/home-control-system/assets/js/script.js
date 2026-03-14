/* ===============================================
  OPEN CLOSE Menu
============================================= */

function home_control_system_open_menu() {
  jQuery('button.menu-toggle').addClass('close-panal');
  setTimeout(function(){
    jQuery('nav#main-menu').show();
  }, 100);

  return false;
}
jQuery( "button.menu-toggle").on("click", home_control_system_open_menu);

function home_control_system_close_menu() {
  jQuery('button.close-menu').removeClass('close-panal');
  jQuery('nav#main-menu').hide();
}

jQuery( "button.close-menu").on("click", home_control_system_close_menu);


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
  Custom Cursor
============================================= */

const home_control_system_customCursor = {
  init: function () {
    this.home_control_system_customCursor();
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
  home_control_system_customCursor: function () {
    const home_control_system_cursorDot = this.select(".cursor-point");
    const home_control_system_cursorOutline = this.select(".cursor-point-outline");
    if (this.isVariableDefined(home_control_system_cursorDot) && this.isVariableDefined(home_control_system_cursorOutline)) {
      const cursor = {
        delay: 8,
        _x: 0,
        _y: 0,
        endX: window.innerWidth / 2,
        endY: window.innerHeight / 2,
        cursorVisible: true,
        cursorEnlarged: false,
        $dot: home_control_system_cursorDot,
        $outline: home_control_system_cursorOutline,

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

          home_control_system_customCursor.selectAll("a, button").forEach((el) => {
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
home_control_system_customCursor.init();

/* ===============================================
  Progress Bar
============================================= */
const home_control_system_progressBar = {
  init: function () {
      let home_control_system_progressBarDiv = document.getElementById("elemento-progress-bar");

      if (home_control_system_progressBarDiv) {
          let home_control_system_body = document.body;
          let home_control_system_rootElement = document.documentElement;

          window.addEventListener("scroll", function (event) {
              let home_control_system_winScroll = home_control_system_body.scrollTop || home_control_system_rootElement.scrollTop;
              let home_control_system_height =
              home_control_system_rootElement.scrollHeight - home_control_system_rootElement.clientHeight;
              let home_control_system_scrolled = (home_control_system_winScroll / home_control_system_height) * 100;
              home_control_system_progressBarDiv.style.width = home_control_system_scrolled + "%";
          });
      }
  },
};
home_control_system_progressBar.init();

/* ===============================================
   sticky copyright
============================================= */

window.addEventListener('scroll', function() {
  var home_control_system_footer = document.querySelector('.sticky-copyright');
  if (!home_control_system_footer) return; 

  var home_control_system_scrollTop = window.scrollY || document.documentElement.home_control_system_scrollTop;

  if (home_control_system_scrollTop >= 100) {
    home_control_system_footer.classList.add('active-sticky');
  }
});

/* ===============================================
   sticky sidebar
============================================= */

window.addEventListener('scroll', function () {
  var home_control_system_sidebar = document.querySelector('.sidebar-sticky');
  if (!home_control_system_sidebar) return;

  var home_control_system_scrollTop = window.scrollY || document.documentElement.scrollTop;
  var home_control_system_windowHeight = window.innerHeight;
  var home_control_system_documentHeight = document.documentElement.scrollHeight;

  var home_control_system_isBottom = home_control_system_scrollTop + home_control_system_windowHeight >= home_control_system_documentHeight - 100;

  if (home_control_system_scrollTop >= 100 && !home_control_system_isBottom) {
    home_control_system_sidebar.classList.add('sidebar-fixed');
  } else {
    home_control_system_sidebar.classList.remove('sidebar-fixed');
  }
});
