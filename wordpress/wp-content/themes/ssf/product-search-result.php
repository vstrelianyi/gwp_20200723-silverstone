<div class="search-result">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Магазин</a>
                    <i class="icon-arrow"></i>
                </li>
                <li>
                    <span>Результаты поиска</span>
                </li>
            </ul>
        </div>

        <div class="search-result__title">Результаты поиска по запросу “<?php echo get_search_query()?>”</div>

        <div class="category__list search-result__list">

            <?php if ( have_posts() ) : ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) :

                    the_post();

                    wc_get_template_part('content', 'product');

                endwhile;

            else :

                echo 'Нет результатов';

            endif; ?>

        </div>
    </div>
</div>
