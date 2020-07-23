( function( $ ) {

    if(typeof liveSearch === 'undefined'){
        console.warn( 'liveSearch obj not fount livesearch will not work' );
        return;
    }
    if(typeof ssfData === 'undefined'){
        console.warn( 'ssfData obj not fount livesearch will not work' );
        return;
    }

    var products = '';

    // get_products
    $('a[data-target="#search-popup"]').click(function(){
       if(products.length !== 0){
            return;
        }
        get_products();
    });

    function get_products(){
        $.ajax({
            type : 'POST',
            url : ssfData.ajaxUrl, // admin-ajax.php URL
            data: liveSearch,
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
                html = $.parseHTML(httpResponse);
                products = html;
                $('#search-result-list .overview').append(html);
                $(".customScrollbar").customScrollbar('resize', true);
            },
            complete: function(){
                // code
            }
        });
    }

    // live search
    $(document.body).on('keyup', ':input[name=s]', function(){

        var elements = $('.live-search-item');

        var filter    = $(this).val();
        var has_match = false;

        // $('a.search-drop__item').remove();
        // no_result.hide();

        // if( $.isEmptyObject( postsForSearch ) ){
        //     return;
        // }

        if( filter.length === 0 ){
            return;
        }

        $.each( elements, function( key, value ) {

            var el = $(value);
            var el_name = $('.name', el);
            var title = el_name.text();


            if( title.search( new RegExp(filter, "gi") ) >= 0 ) {
                has_match = true;
                var marked_text = title.match(   new RegExp( filter, "i" ) );
                var title       = title.replace( new RegExp(marked_text, "i"), '<span class="marked">'+ marked_text +'</span>' );
                el_name.html(title);
                el.show();
            }
            else{
                el.hide()
            }

        });

        $(".customScrollbar").customScrollbar('resize', true);

        if( ! has_match ){
            // no_result.show();
        }
    });





} )( jQuery );