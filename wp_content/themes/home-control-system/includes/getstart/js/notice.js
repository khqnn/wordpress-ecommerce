jQuery("body").on("click", '#home-control-system-welcome-notice .notice-dismiss', function (event) {
    event.preventDefault();

    console.log("close clicked");

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
          action: 'home_control_system_dismissed_notice',
      },
      success: function () {
          // Remove the notice on success
          $('.notice[data-notice="example"]').remove();
      }
    });
  }
)