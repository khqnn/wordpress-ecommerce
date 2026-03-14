jQuery("body").on("click", '#luxury-watch-store-welcome-notice .notice-dismiss', function (event) {
    event.preventDefault();

    console.log("close clicked");

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
          action: 'luxury_watch_store_dismissed_notice',
      },
      success: function () {
          // Remove the notice on success
          $('.notice[data-notice="example"]').remove();
      }
    });
  }
)