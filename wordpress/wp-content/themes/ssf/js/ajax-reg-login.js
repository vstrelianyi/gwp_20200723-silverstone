( function( $ ) {

    $(':input[name=ssf_ajax_registration]').on('click', function(e){
        if( ! $('#auth-reg-agree').is(':checked') ) {
            e.preventDefault();
            return false;
        };
    })

    $('#ssf_ajax_register_form, #ssf_ajax_login_form').on('submit',function(e){
        e.preventDefault();

        var form = $(this);

        var errorBlock = form.find('.ajax-error-message');
        var errorMessage = errorBlock.find('p');

        jQuery.ajax({
            type: "POST",
            url: ssfData.ajaxUrl,
            data: form.serialize() + '&action=ssf_ajax_registration_login',
            success: function(response){
                r = $.parseJSON(response);

                if(r.result == 'error'){
                    errorMessage.text(r.message);
                    errorBlock.show();
                }
                else if(r.result == 'success'){
                    location.reload();
                }
                else{
                    alert('undefined error');
                }
            },
            error: function(results) {
                alert('error');
            }
        });
    });

} )( jQuery );