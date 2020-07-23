( function($) {

    if( ssfData.ajaxUrl === undefined ){
        console.error('ssfData.ajaxUrl === undefined, ajax comment will not work');
        return false;
    }

    $('.ssf-comment-form').on('submit',function (event) {

        event.preventDefault();

        var form = $(this);

        var comment_type = $(this).find('[name=comment_type]').val();

        $.ajax({
            type : 'POST',

            url : ssfData.ajaxUrl, // admin-ajax.php URL
            data: $(this).serialize() + '&action=ssf_ajax_comments' + '&rating=' + $('#comment-product-rating').rateYo("rating"), // send form data + action parameter
            beforeSend: function(xhr){
                // what to do just after the form has been submitted
            },
            error: function (request, status, error) {
                if( status === 500 ){
                    alert( 'Error while adding comment' );
                } else if( status === 'timeout' ){
                    alert('Error: Server doesn\'t respond.');
                } else {
                    // process WordPress errors
                    var wpErrorHtml = request.responseText.split("<p>"),
                        wpErrorStr = wpErrorHtml[1].split("</p>");

                    alert( wpErrorStr[0] );
                }
            },
            success: function ( httpResponse ) {

                var response = JSON.parse(httpResponse);

                if(response.result === 'success'){
                    if( comment_type === 'comment' ){
                        openModal('#review-success');
                    }
                    if( comment_type === 'comment_qa' ){
                        openModal('#question-success');
                    }
                }
                else if(response.result === 'error' && response.message !== undefined ){
                    alert(response.message);
                    closeModals();
                }
                else{
                    alert('Comment error');
                    closeModals();
                }

                form.find('.comment-popup-textarea').val('');
            },
            complete: function(){
                // what to do after a comment has been added
            }
        });

    });

    $('.ssf-comment-lazy-load').on('click', function (event) {

        event.preventDefault();

        var offset = $(this).data('offset');
        var postId = $(this).data('post-id');
        var comment_type = $(this).data('comment_type');
        var button = $(this);
        var data = 'post_id=' + postId + '&offset='+ offset +'&action=ssf_comment_lazy_load';
        var list_block = $(this).closest('.reviews').find('.reviews__list');

        if(button.hasClass('_loading')){ // Prevent multi click
            return;
        }
        button.addClass('_loading');

        if(comment_type === 'qa'){
            data += '&comment_type=qa';
        }

        $.ajax({
            type : 'POST',

            url : ssfData.ajaxUrl, // admin-ajax.php URL
            data: data, // send form data + action parameter
            beforeSend: function(xhr){
                // what to do just after the form has been submitted
            },
            error: function (request, status, error) {
                if( status == 500 ){
                    alert( 'Error while adding comment' );
                } else if( status == 'timeout' ){
                    alert('Error: Server doesn\'t respond.');
                } else {
                    // process WordPress errors
                    var wpErrorHtml = request.responseText.split("<p>"),
                        wpErrorStr = wpErrorHtml[1].split("</p>");

                    alert( wpErrorStr[0] );
                }
            },
            success: function ( httpResponse ) {

                var response = JSON.parse(httpResponse);

                if(response.html != undefined){
                    list_block.append(response.html);
                    button.remove();
                }
            },
            complete: function(){
                button.removeClass('_loading');
            }
        });
    });

    $(document).on('click', '.do_comment_like', function (e) {

        e.preventDefault();

        var target = $(e.target).hasClass('do_comment_like') ? $(e.target) : $(e.target).closest('.do_comment_like');
        var count_value = $(target).find('.count_value');
        var data = 'comment_id=' + target.data('comment_id') +  '&like_action=' + target.data('like_action') + '&action=ajax_comment_like';

        target.css('opacity', 0);

        $.ajax({
            type : 'POST',

            url : ssfData.ajaxUrl, // admin-ajax.php URL
            data: data, // send form data + action parameter
            beforeSend: function(xhr){
                // what to do just after the form has been submitted
            },
            error: function (request, status, error) {
                if( status == 500 ){
                    alert( 'Error while adding comment' );
                } else if( status == 'timeout' ){
                    alert('Error: Server doesn\'t respond.');
                } else {
                    // process WordPress errors
                    var wpErrorHtml = request.responseText.split("<p>"),
                        wpErrorStr = wpErrorHtml[1].split("</p>");

                    alert( wpErrorStr[0] );
                }
            },
            success: function ( httpResponse ) {
                if($.isNumeric(httpResponse)){
                    count_value.html(httpResponse);
                }
            },
            complete: function(){
                target.css('opacity', 1);
            }
        });
    });

} )(jQuery);
