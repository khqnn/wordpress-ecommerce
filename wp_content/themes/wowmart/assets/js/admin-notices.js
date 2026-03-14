/**
 * WowMart Admin Notices JavaScript
 *
 * @package WowMart
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Documentation notice - X button (permanent dismiss)
        $(document).on('click', '.wowmart-doc-notice .notice-dismiss', function() {
            var $notice = $(this).closest('.wowmart-doc-notice');
            var noticeType = $notice.data('notice');
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'wowmart_dismiss_documentation_notice',
                    notice: noticeType,
                    nonce: wowmartNoticeData.docNonce
                }
            });
        });

        // Pro notice - X button (temporary hide, show on next page load)
        $(document).on('click', '.wowmart-pro-notice .notice-dismiss', function(e) {
            e.preventDefault();
            var $notice = $(this).closest('.wowmart-pro-notice');
            
            // Just hide temporarily with animation
            $notice.fadeOut(300, function() {
                $(this).addClass('wowmart-notice-hidden');
            });
            
            // No AJAX call - will show again on next page load
        });

        // Pro notice - "Dismiss this notice" link (7 days dismiss)
        $(document).on('click', '.wowmart-dismiss-link', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $notice = $button.closest('.wowmart-pro-notice');
            
            // Disable button during request
            $button.prop('disabled', true).text($button.data('loading-text') || 'Dismissing...');
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'wowmart_dismiss_pro_notice',
                    nonce: wowmartNoticeData.proNonce
                },
                success: function(response) {
                    if (response.success) {
                        // Fade out and remove
                        $notice.fadeOut(400, function() {
                            $(this).remove();
                        });
                    } else {
                        alert(response.data || 'Failed to dismiss notice.');
                        $button.prop('disabled', false).text($button.data('original-text'));
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                    $button.prop('disabled', false).text($button.data('original-text'));
                }
            });
        });

        // Store original text for dismiss link
        $('.wowmart-dismiss-link').each(function() {
            $(this).data('original-text', $(this).text());
        });

    });

})(jQuery);
