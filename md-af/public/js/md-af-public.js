/*jslint browser: true, devel: true*/
/*global jQuery, mdaf_data */

(function ($) {
    'use strict';

    /**
     * @returns {void}
     */
    $.fn.mdAjaxForm = function (options) {

        var settings = $.extend({
            postType: 'mdaf',
            formID: 'uncategorized',
            sendEmail: true,
            callbackSuccess: function (response, form) {
                alert(mdaf_data.texts.success);
            },
            callbackError: function (response, form) {

                console.log(response);
                if (response.errors.code === 'ValidationErrors') {
                    response.errors.messages.forEach(function (item) {
                        $('[name=' + item.field + ']').addClass('error').data('message', item.error);
                    });
                } else {
                    alert(response.errors.message);
                }

            },
            beforeSubmit: function (form, data, submit) {
                submit.prop('disabled', true);
            },
            afterSubmit: function (form, data, submit) {
                submit.prop('disabled', false);
            }
        }, options);

        return this.each(function () {

            var form            = $(this),
                submit          = $(this).find('[type=submit]');

            function submitData(data) {

                settings.beforeSubmit(form, data, submit);

                $.post(mdaf_data.ajaxurl, data, function (response) {

                    if (response.success === true) {
                        settings.callbackSuccess(response, form);
                    } else {
                        settings.callbackError(response, form);
                    }

                }, 'json').done(settings.afterSubmit(form, data, submit));

            }

            form.on('submit.mdAjaxForm', function (event) {

                event.preventDefault();
                var data = $(this).serializeArray();
                data.push(
                    {name: 'action',     value: 'mdaf_save'},
                    {name: 'nonce',      value: mdaf_data.nonce},
                    {name: 'form_id',    value: settings.formID},
                    {name: 'post_type',  value: settings.postType},
                    {name: 'send_email', value: settings.sendEmail}
                );
                submitData(data);

            });

        });

    };

}(jQuery));
