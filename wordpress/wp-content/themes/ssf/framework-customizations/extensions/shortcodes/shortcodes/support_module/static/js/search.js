(function ($) {

    $('.product-show').on('click keyup keydown', function () {

        var pathname = window.location.pathname; // Returns path only
        var origin   = window.location.origin;   // Returns base URL
        window.location = origin + pathname;
    });

    $("#support_search_input").on('keyup', function(event){

        var filter    = $(this).val();

        if(filter.length == ''){
            return;
        }

        var search_items = $('.s_qa_item');

        $.each( search_items, function( key, value ) {

            var list_item = $(value);
            var item_text = list_item.text();

            if( item_text.search( new RegExp(filter, "gi") ) >= 0 ) {

                var marked_text = item_text.match(   new RegExp( filter, "i" ) );
                var title       = item_text.replace( new RegExp(marked_text, "i"), '<span class="marked">'+ marked_text +'</span>'  );
                list_item.html(title);
                list_item.show();

            }
            else{
                list_item.hide();
            }

        });
        //
        // if( ! has_match ){
        //     no_result.show();
        // }
    });

    $('.s_qa_item').on('click', function () {

        var search_item = $(this);

        var group_id = search_item.data('group-id');
        var question_id = search_item.data('question-id');

        var question = $('#' + question_id);

        var block_title = question.siblings('.title');

        $('[data-target="#' + group_id + '"]').click();

        question.insertAfter(block_title);

        ssf_move_to(block_title);
    });

})(jQuery)