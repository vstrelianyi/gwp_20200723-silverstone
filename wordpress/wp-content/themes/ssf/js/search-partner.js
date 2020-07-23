(function ($) {


$("#city-search-input").on('keyup', function(event){

    var filter    = $(this).val();

    if(filter.length == ''){
        $('#locations-search-wrapper form').removeClass('opened focused');
        $('#locations-search-dropdown').hide();
        return;
    }

    var search_items = $('.city-search-item');

    $.each( search_items, function( key, value ) {

        var list_item = $(value);
        var item_text = list_item.text();

        if( item_text.search( new RegExp(filter, "gi") ) >= 0 ) {

            console.log(list_item.text());

            var marked_text = item_text.match(   new RegExp( filter, "i" ) );
            var title       = item_text.replace( new RegExp(marked_text, "i"), '<span class="marked">'+ marked_text +'</span>'  );
            list_item.html(title);
            list_item.show();

        }
        else{
            list_item.hide();
        }

        // if( value.title.search( new RegExp(filter, "gi") ) >= 0 ) {
        //     has_match = true;
        //     var marked_text = value.title.match(   new RegExp( filter, "i" ) );
        //     var title       = value.title.replace( new RegExp(marked_text, "i"), '<span class="marked">'+ marked_text +'</span>'  );
        //     search_list.append( render_search_item(value,title) );
        // }
    });
    //
    // if( ! has_match ){
    //     no_result.show();
    // }
});

})(jQuery)