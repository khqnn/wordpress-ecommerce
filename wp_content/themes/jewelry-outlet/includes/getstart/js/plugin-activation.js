jQuery(document).ready(function($) {
    'use strict';
    var jewelry_outlet_this_obj = jewelry_outlet_plugin_activate_plugin;

    $('#wpelemento_importer_editor .plugin-activation-redirect a').addClass('wpi-redirect-to-dashboard');

    $(document).on('click', '.jewelry-outlet-plugin-install', function(event) {

        event.preventDefault();
        var button = $(this);
        var slug = button.data('slug');
        button.text(jewelry_outlet_this_obj.installing + '...').addClass('updating-message');
        wp.updates.installPlugin({
            slug: slug,
            success: function(data) {
                button.attr('href', data.activateUrl);
                button.text(jewelry_outlet_this_obj.activating + '...');
                button.removeClass('button-secondary updating-message jewelry-outlet-plugin-install');
                button.addClass('button-primary jewelry-outlet-plugin-activate');
                button.trigger('click');
            },
            error: function(data) {
                jQuery('.jewelry-outlet-recommended-plugins .jewelry-outlet-activation-note').css('display','block');
                //console.log('error', data);
                button.removeClass('updating-message');
                button.text(jewelry_outlet_this_obj.error);
            },
        });
    });

    $(document).on('click', '.jewelry-outlet-plugin-activate', function(event) {
        var redirect_class = jQuery(this).attr('class');
        var data_plugin = jQuery(this).attr('data-slug');

        let redirect_url = '#';
        if ( data_plugin == 'wpelemento-importer' ) {
          redirect_url = jewelry_outlet_this_obj.addon_admin_url;
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
                    button.text(jewelry_outlet_this_obj.activating + '...');
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
        location.href = jewelry_outlet_this_obj.wpelementoimpoter_admin_url;
    });
});
