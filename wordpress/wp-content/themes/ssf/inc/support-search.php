<?php

if ( wp_doing_ajax() ) {
    add_action( 'wp_ajax_ssf_support_search', 'ssf_support_search_ajax_handler' );
    add_action( 'wp_ajax_nopriv_ssf_support_search', 'ssf_support_search_ajax_handler' );
}

function ssf_support_search_js() {
    global $wp;

    $request = $wp->request;
?>
    <script>
        (function(){

            if (typeof ssfData === 'undefined'){
                console.warn("ssf_support_search: ssfData object not found")
            }

            var products,
                result = document.getElementById("ssf-support-search-result"),
                elements = document.getElementsByClassName("support-search-item"),
                searchField = document.getElementById("ssf-support-search-input");
                closeButton = document.getElementById("ssf-support-search-close");

            closeButton.style.display = 'none';

            function supportSearch(){
                var nonce = "<?php echo wp_create_nonce( 'ssf_support_search_ajax_handler' ); ?>",
                    data = "_ajax_nonce=" + nonce + "&action=ssf_support_search" + "&request=<?php echo $request; ?>",
                    request = new XMLHttpRequest();
                request.open('POST', ssfData.ajaxUrl, true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.onload = function() {
                    if ( request.status >=200 && request.status < 400 && request.responseText != -1 ) {
                        try {
                            products = request.responseText;
                            result.insertAdjacentHTML('beforeend', request.responseText);

                            // Hide elements after loading
                            for ( var i = 0; i < elements.length; i++ ) {
                                elements[i].style.display = 'none';
                            }
                        } catch(e) {}
                    }
                }
                request.send(data);
            };


            searchField.addEventListener('click', function(){
                if ( products === undefined ) {
                    supportSearch();
                }
            });

            searchField.addEventListener('keyup', function(){
                var matches = 0,
                    itemsToDisplay = 5,
                    filter = searchField.value;

                result.style.display = '';

                if ( filter.length === 0 ) {
                    result.style.display = 'none';
                    closeButton.style.display = 'none';
                    return;
                }

                for ( var i = 0; i < elements.length; i++ ) {
                    var title = elements[i].querySelectorAll('h5')[0],
                        titleText = elements[i].querySelectorAll('h5')[0].textContent;

                    if ( titleText.search( new RegExp( filter, 'gi' ) ) >= 0 ) {
                        matches++;
                        if ( matches <= itemsToDisplay ) {
                            var marked = titleText.match( new RegExp( filter, 'i' ) );
                            titleText = titleText.replace( new RegExp( marked, 'i' ), '<span class="marked">' + marked + '</span>');
                            title.innerHTML = titleText;
                            elements[i].style.display = '';
                        } else {
                            elements[i].style.display = 'none';
                        }
                    } else {
                        elements[i].style.display = 'none';
                    }
                }

                if (matches > 0) {
                    closeButton.style.display = '';
                }
            });

            closeButton.addEventListener('click', function(){
                if (result.style.getPropertyValue('display') === 'block' || searchField.value !== '') {
                    result.style.display = 'none';
                    closeButton.style.display = 'none';
                    searchField.value = '';
                }
            });
        })();
    </script>
<?php
}

function ssf_support_search_ajax_handler() {
    $response = array();

    check_ajax_referer( 'ssf_support_search_ajax_handler' );

    if ( empty( $_POST['action'] ) || empty( $_POST['_ajax_nonce'] ) ) {
        $response['message'] = 'Bad request';
        wp_send_json( $response );
    }

    $args = array(
        'category' => array(
            'kombo-ustrojstva',
            'radar-detektory',
            'videoregistratory',
        ),
        'limit' => -1,
    );

    $products = wc_get_products( $args );

    if ( empty( $products ) && ! is_array( $products ) ) {
        $response['message'] = 'No products';
        wp_send_json( $response );
    }

    foreach ( $products as $product ) {
        $terms = get_the_terms( $product->get_id(), 'product_cat' );

        foreach ( $terms as $term ) {
            $product_cat_id = $term->term_id;
            break;
        }

        if ( ! $product_cat_id ) {
            continue;
        }

        $term = get_term_by( 'id', $product_cat_id, 'product_cat' );

        $request = $_POST['request'] . '/';

        $url = home_url( add_query_arg( array( 'pid' => $product->get_id(), 'cat' => $term->slug ), $request ) );

        $image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

        $image = $product->get_image( $image_size );

        ?>
        <li class="support-search-item" onclick="window.location.href = '<?php echo $url; ?>#support-block'">
            <?php echo $image; ?>
            <h5 class="name"><?php echo $product->get_title(); ?></h5>
        </li>
        <?php
    }

    wp_reset_postdata();
    wp_reset_query();
    wp_die();
}
