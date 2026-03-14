jQuery(document).ready(function($) {
    'use strict';
    var home_control_system_this_obj = home_control_system_plugin_activate_plugin;

    $('#wpelemento_importer_editor .plugin-activation-redirect a').addClass('wpi-redirect-to-dashboard');

    $(document).on('click', '.home-control-system-plugin-install', function(event) {

        event.preventDefault();
        var button = $(this);
        var slug = button.data('slug');
        button.text(home_control_system_this_obj.installing + '...').addClass('updating-message');
        wp.updates.installPlugin({
            slug: slug,
            success: function(data) {
                button.attr('href', data.activateUrl);
                button.text(home_control_system_this_obj.activating + '...');
                button.removeClass('button-secondary updating-message home-control-system-plugin-install');
                button.addClass('button-primary home-control-system-plugin-activate');
                button.trigger('click');
            },
            error: function(data) {
                jQuery('.home-control-system-recommended-plugins .home-control-system-activation-note').css('display','block');
                //console.log('error', data);
                button.removeClass('updating-message');
                button.text(home_control_system_this_obj.error);
            },
        });
    });

    $(document).on('click', '.home-control-system-plugin-activate', function(event) {
        var redirect_class = jQuery(this).attr('class');
        var data_plugin = jQuery(this).attr('data-slug');

        let redirect_url = '#';
        if ( data_plugin == 'wpelemento-importer' ) {
          redirect_url = home_control_system_this_obj.addon_admin_url;
        } 

        event.preventDefault();
        var button = $(this);
        var url = button.attr('href');
        if (typeof url !== 'undefined') {
            // Request plugin activation.
            jQuery.ajax({
                async: true,
                type: 'GET',
                url: url,
                beforeSend: function() {
                    button.text(home_control_system_this_obj.activating + '...');
                    button.removeClass('button-secondary');
                    button.addClass('button-primary activate-now updating-message');
                },
                success: function(data) {
                    if(redirect_class.indexOf('wpi-redirect-to-dashboard') != -1){
                        location.href = redirect_url;
                    }else{
                        location.reload();
                    }
                }
            });
        }
    });

    jQuery('.wpelementoimpoter-dashboard-page-btn').click(function(){
        location.href = home_control_system_this_obj.wpelementoimpoter_admin_url;
    });
});
