( function( $ ) {

    $('.nice-select.orderby').on('change', function () {

        $(this).closest('form').submit();

    });

    $(document).ready(function($){
        $('body').on( 'added_to_cart updated_cart_totals', function(){
            ssf_get_cart_count();
        });
    });

    function ssf_get_cart_count() {

        var action = 'ssf_get_cart_count';

        if( ssfData === 'undefined' || ssfData.ajaxUrl === 'undefined' ){
            console.error('ssfData.ajaxUrl fail');
            return;
        }

        $.post( ssfData.ajaxUrl + '?action=' + action, function( response ) {

            var q_block = $('.cart_items_quantity');

            q_block.addClass('updating');
            q_block.text(parseInt(response, 10));
            // q_block.removeClass('updating');

            setTimeout( function(){
                q_block.removeClass('updating');
            }, 500);


        });
    }

    $('.single_product_quantity').on('change input', function () {
       $('.product__to-cart').data( 'quantity', $(this).val() );
    });

    $(document.body).on('change input', '.woocommerce-cart-form .product__quant-wrap :input', function () {
        $("[name='update_cart']").click();
    });

    // Checkout
    $(document.body).on('click', '#check-account-values', function (event) {

        var fields = $('.woocommerce-checkout :input[data-a-value]');

        var checkbox = $(this);

        fields.each(function( i, el){

            if(checkbox.is(':checked')){

                $(this).val( $(this).data('a-value') ).trigger('change');
            }
            else{

                $(this).val('').trigger('change');
            }
        });
    })

    $(document).ready(function(){
        $('.checkout.woocommerce-checkout').removeAttr( 'novalidate' );
    });

    $(document.body).on('keyup input', '#_account_password_confirmation, #_account_password', function(){

        var password = $('#_account_password');
        var password_conf = $('#_account_password_confirmation');
        var checkout_form = $('.woocommerce-checkout');

        checkout_form.addClass('processing');

        if(password_conf.val().length < 1){
            return;
        }

        var password_conf_wrap = password_conf.closest('.input-col');

        var error_m = $('<div class="error-message">Пароли не совпадают!</div>');

        $('.error-message' , password_conf_wrap).remove();

        if( password.val() === password_conf.val() ){
            password_conf.removeClass('error');
            checkout_form.removeClass('processing');
        }
        else{
            password_conf.addClass('error');
            error_m.insertAfter( password_conf );
        }
    });

} )( jQuery );