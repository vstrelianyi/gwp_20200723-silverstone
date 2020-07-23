<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SilverStoneF1
 */

get_header();
?>

<div class="search-result">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Магазин</a>
                    <i class="icon-arrow"></i>
                </li>
                <li>
                    <span>404</span>
                </li>
            </ul>
        </div>
        <div class="search-result__title">Страница не найдена, ошибка 404.</div>
    </div>
</div>

<?php
get_footer();
