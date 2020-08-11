<?php
/**
 * Enqueue scripts and styles.
 */

function ssf_scripts()
{

    wp_deregister_script( 'jquery' );
    // Change the URL if you want to load a local copy of jQuery from your own server.
    wp_register_script( 'jquery', get_template_directory_uri() .'/assets/js/jquery-3.2.1.js', array(), '3.2.1' );
    wp_enqueue_style('jquery');

    if( get_page_template_slug() == 'landing.php' ){
        wp_enqueue_style('landing-style', get_template_directory_uri() . '/separate_landing_page/css/main.css' , array(), null, 'all');
        wp_enqueue_script('landing-plugins', get_template_directory_uri() .'/separate_landing_page/js/plugins.min.js', array(), null, true );
        wp_enqueue_script('landing-scripts', get_template_directory_uri() .'/separate_landing_page/js/scripts.min.js', array(), null, true );
        wp_localize_script('landing-scripts', 'landingData',[
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('landing_form'),
            'action' => 'landing_form'
        ]);
        return;
    }
    // Styles
    // wp_enqueue_style('ssf-style', get_template_directory_uri() . '/assets/css/main.css' , array(), null, 'all');
    wp_enqueue_style('ssf-style', get_template_directory_uri() . '/assets/css/expanded.css', array(), null, 'all');
		wp_enqueue_style('ssf-additional-style', get_template_directory_uri() . '/assets/css/additional.css');

		wp_enqueue_style('repair-style', get_template_directory_uri() . '/assets/css/repair.css', array(), null, 'all');

    // Scripts
    // wp_enqueue_script('jquery-3.2.1', get_template_directory_uri() .'/assets/js/jquery-3.2.1.js', array(), null, true );

    wp_enqueue_script('plugins.min', get_template_directory_uri() .'/assets/js/plugins.min.js', array(), null, true );
		wp_enqueue_script('scripts.min', get_template_directory_uri() .'/assets/js/scripts.min.js', array(), null, true );
    wp_enqueue_script('custom-js', get_template_directory_uri() .'/js/custom.js', array(), null, true );
    wp_enqueue_script('ajax-comment', get_template_directory_uri() .'/js/ajax-comment.js', array('scripts.min'), null, true );

    wp_localize_script('scripts.min', 'ssfData',[
        'ajaxUrl' => admin_url( 'admin-ajax.php' )
    ]);

    // Underscore scripts
    wp_enqueue_script('ssf-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
    wp_enqueue_script('ssf-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
		}

		wp_enqueue_script('repair-js', get_template_directory_uri() .'/assets/js/repair.js', array('scripts.min'), null, true );
}

add_action('wp_enqueue_scripts', 'ssf_scripts');