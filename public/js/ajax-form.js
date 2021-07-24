(function ($) {
    'use strict';


    var submitBtn = document.querySelector('#send-message-btn');
    var form = $('.messenger-box-form'),
        message = $('.messenger-box-contact__msg'),
        form_data;

    // Success function
    function done_func(response) {
        // setTimeout(function (){
        submitBtn.innerHTML = 'Send Message';
        message.fadeIn().removeClass('alert-danger').addClass('alert-success');
        message.text(response);
        setTimeout(function () {
            message.fadeOut();
        }, 3000);
        form.find('input:not([type="submit"]), textarea').val('');
        // }, 2000)
    }

    // fail function
    function fail_func(data) {
        // setTimeout(function (){
        submitBtn.innerHTML = 'Send Message';
        message.fadeIn().removeClass('alert-success').addClass('alert-success');
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 3000);
        // }, 2000)
    }

    form.submit(function (e) {
        e.preventDefault();
        form_data = $(this).serialize();
        submitBtn.innerHTML = 'Sending...';
        setTimeout(function () {
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form_data
            })
                .done(done_func)
                .fail(fail_func);
        }, 2000)
    });

})(jQuery);