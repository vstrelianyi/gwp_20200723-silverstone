<?php

    add_shortcode( 'popular_products' , 'popular_products' );

    function popular_products( $product_category = null ){

        $cat_name = 'товары';

        if( $product_category instanceof WP_Term){

            $options = fw_get_db_term_option($product_category->term_id, $product_category->taxonomy, 'popular_products',[]);
            $popular_products_ids = !empty($options['products']) && is_array($options['products']) ? $options['products'] : [];
            $cat_name = $product_category->name;
        }
        else{
            $options = fw_get_db_settings_option('products',[]);
            $popular_products_ids = !empty($options) && is_array($options) ? $options : [];
        }

        ob_start();

        foreach ($popular_products_ids as $popular_product){

            $id = !empty($popular_product['product_id']) ? $popular_product['product_id'] : null;
            $css_class = !empty($popular_product['tale_css_class']) ? $popular_product['tale_css_class'] : null;

            $post = get_post((int) $id);
            $product = wc_get_product((int) $id);

            if( !($post instanceof WP_Post) || !($product instanceof WC_Product_Simple) ){
                continue;
            }

            setup_postdata( $GLOBALS['post'] =& $post );

            if($css_class == 'w50'){
                wc_get_template('content-product-detail.php', ['css_class' => 'w50']);
            }
            else{
                wc_get_template('content-product.php');
            }
        }

        $product_html = ob_get_clean();

        ob_start();
        if($product_html){
            ?>
            <div class="popular-block">
                <div class="container">
                    <h2>Популярные <?php echo $cat_name;?></h2>
                    <div class="popular-block__list">
                        <?php echo $product_html;?>
                    </div>
                </div>
                <?php if (is_front_page()){
                    echo '<ul class="midpage__social">
                            <li>
                                <a href="https://www.youtube.com/channel/UC2DYKfd4O7N85yy6x81SC4A/feed">
                                    <i class="icon-youtube"></i>
                                </a>
                            </li>

                            <li>
                                <a href="http://vk.com/club68667886">
                                    <i class="icon-vk"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.facebook.com/pages/SilverStone-F1/1474637369415235">
                                    <i class="icon-fb"></i>
                                </a>
                            </li>

                            <li>
                                <a href="http://instagram.com/silverstone_f1/">
                                    <i class="icon-instagram"></i>    
                                    <!--<span class="icon-wrap"><img src="http://localhost/ssf1/wp-content/themes/ssf/assets/img/icons/instagram.svg" alt=""></span>-->
                                </a>
                            </li>
                        </ul>';
                } ?>
            </div>
            <?php
        }

        $result_html = ob_get_clean();

        if($product_category){
            echo $result_html;
        }
        else{
            return $result_html;
        }
    }

