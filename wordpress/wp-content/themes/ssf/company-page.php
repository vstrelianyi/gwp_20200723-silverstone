<?php /* Template Name: Company_template */

add_filter( 'body_class',function($classes){
    $classes[] = 'company-page';
    return $classes;
} );

get_header();

?>
   <?php 
                the_post();
                the_content();
            ?>

<?php
get_footer();

