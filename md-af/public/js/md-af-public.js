/*jslint browser: true, devel: true*/
/*global jQuery, mdaf_data */

(function ($) {
    'use strict';

    /**
     * @returns {void}
     */
    $.fn.mdAjaxForm = function () {

        this.each(function () {

            var form   = $(this),
                formID = $(this).attr('id') || 'uncategorized';

            form.on('submit.mdAjaxForm', function (event) {

                event.preventDefault();
                var data = $(this).serializeArray();
                data.push(
                    {name: 'action',  value: 'mdaf_save'},
                    {name: 'nonce',   value: mdaf_data.nonce},
                    {name: 'form_id', value: formID}
                );

                console.log('start');
                $.post(mdaf_data.ajaxurl, data, function (response) {

                    if (response.success === true) {
                        form.trigger('mdaf_success', response);
                    } else {
                        form.trigger('mdaf_error', response);
                    }

                }, 'json').done(function () {
                    console.log('finish');
                });

            });

        });
        return this;

    };

    $('.mdaf').mdAjaxForm();

}(jQuery));
