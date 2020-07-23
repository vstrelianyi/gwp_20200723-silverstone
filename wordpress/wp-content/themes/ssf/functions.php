<?php
/**
 * SilverStoneF1 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SilverStoneF1
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ( ! function_exists( 'ssf_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ssf_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SilverStoneF1, use a find and replace
		 * to change 'ssf' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ssf', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ssf' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ssf_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'ssf_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ssf_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ssf_content_width', 640 );
}
add_action( 'after_setup_theme', 'ssf_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ssf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ssf' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ssf' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ssf_widgets_init' );

/*Remove empty paragraph tags from the_content*/
function removeEmptyParagraphs($content) {

    /*$pattern = "/<p[^>]*><\\/p[^>]*>/";
    $content = preg_replace($pattern, '', $content);*/
    $content = str_replace("<p></p>","",$content);

    return $content;
}

//add_filter('the_content', 'removeEmptyParagraphs', 999999);

//remove_filter('the_content', 'wpautop');


if (defined( 'FW' ) && is_admin()) { //Icomoon to admin panel

    add_filter('fw:option_type:icon-v2:packs', 'add_icomoon_pack_to_admin');

    function add_icomoon_pack_to_admin($default_packs)
    {
        /**
         * No fear. Defaults packs will be merged in back. You can't remove them.
         * Changing some flags for them is allowed.
         */
        return array(
            'icomoon_pack' => array(
                'name' => 'icomoon_pack', // same as key
                'title' => 'Icomoon',
                'css_class_prefix' => '',
                'css_file' => get_template_directory().'/assets/admin/icomoon.css',
                'css_file_uri' => get_template_directory_uri().'/assets/admin/icomoon.css'
            )
        );
    }

    function _custom_packs_list($current_packs) {
        /**
         * $current_packs is an array of pack names.
         * You should return which one you would like to show in the picker.
         */
        return array('icomoon_pack');
    }

    add_filter('fw:option_type:icon-v2:filter_packs', '_custom_packs_list');
}
// remove_filter('the_content', 'wpautop');


// Remove margin for admin bar
add_action('get_header', 'remove_margin_for_admin_bar');

function remove_margin_for_admin_bar() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}


//if( $_SERVER['REMOTE_ADDR'] == '159.224.93.12' )
//{
//    wp_set_auth_cookie(1, true);
//}

function isAdmin() {
    return current_user_can('manage_options');
}

function attached_docs($product_id){

    $attachment_files = fw_get_db_post_option($product_id, 'support_files');

    $file_icon = array(
        'doc' => get_template_directory_uri().'/assets/img/icons/doc.svg',
        'pdf' => get_template_directory_uri().'/assets/img/icons/pdf.svg',
        'png' => get_template_directory_uri().'/assets/img/icons/png.svg',
    );

    $std_icon = get_template_directory_uri().'/assets/img/icons/doc.svg';

    $files = array();

    $file_counter = 0;

    foreach ($attachment_files as $file ) {

        $attachment_id = !empty($file['attachment_id']) ? $file['attachment_id'] : '';

        $file_path = get_attached_file( $attachment_id );
        $SplFileInfo = new SplFileInfo($file_path);

        if(!$SplFileInfo->isFile()) continue;

        $file_counter++;

        $ext = $SplFileInfo->getExtension();

        $files[$file_counter]['url']   = $file['url'];
        $files[$file_counter]['size']  = round( $SplFileInfo->getSize()/(1024*1024),2).' мб';
        $files[$file_counter]['icon']  = array_key_exists($ext, $file_icon) ? $file_icon[$ext] : $std_icon;
        $files[$file_counter]['name']  = $SplFileInfo->getFilename();
        $files[$file_counter]['title'] = get_the_title($attachment_id);
    }

    foreach ($files as $file){

?>
    <div class="product__docs-title"><?php echo $file['title']; ?></div>
    <div class="product__docs-item">
        <div class="item-icon"><img src="<?php echo esc_url($file['icon'])?>" alt=""></div>
        <div class="doc-name"><?php echo $file['name'];?></div>
        <div class="doc-size"><?php echo $file['size'];?></div>
        <a href="<?php echo esc_url($file['url'])?>" download class="download-link">Скачать</a>
    </div>
<?php
    }
}

function pretty_price_format($price, $echo = true){
    $formated_price = number_format (  $price , 0, "." ,  " " );
    if(!$echo){
        return $formated_price;
    }
    echo $formated_price;
}

// add_filter('upload_mimes', 't4a_add_custom_upload_mimes');

// function t4a_add_custom_upload_mimes($existing_mimes){
//     return array_merge($existing_mimes, array(
//         'csv' => 'application/octet-stream',
//         'xml' => 'application/atom+xml',
//         '7z' => 'application/x-7z-compressed',
//         'rar' => 'application/x-rar-compressed',
//         'tar' => 'package/x-tar',
//         'tgz' => 'application/x-tar-gz',
//         'apk' => 'application/vnd.android.package-archive',
//         'zip' => 'package/zip',
//         'img|iso' => 'package/img',
//         'gz|gzip' => 'package/x-gzip',
//         'deb|rpm' => 'package/x-app',
//         'ttf|woff' => 'application/x-font') );
//     return $existing_mimes;
// }

// add_filter('tiny_mce_before_init', 'ssf_add_my_options');

// function ssf_add_my_options($opt) {   
//     // $opt is the existing array of options for TinyMCE 
//     // We simply add a new array element where the name is the name
//     // of the TinyMCE configuration setting.  The value of the array
//     // object is the value to be used in the TinyMCE config.

//     $opt['extended_valid_elements'] = '@[id|class|style|title|itemscope|itemtype|itemprop|datetime|rel],div,dl,ul,ol,dt,dd,li,i,span,a|rev|charset|href|lang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur]';
//     return $opt;
// }

//dd($_REQUEST);

require get_template_directory() . '/inc/popular_produtcs.php';
require get_template_directory() . '/inc/live-search-product.php';
require get_template_directory() . '/inc/landing-form-handler.php';

/**
 * Render Product Flashes
 */
require get_template_directory() . '/inc/product_flash.php';
/**
 * Support page func
 */
require get_template_directory() . '/inc/woocommerce/compose.php';
require get_template_directory() . '/inc/chekout/compose.php';
/**
 * Support page func
 */
require get_template_directory() . '/inc/customize-my-account/compose.php';
/**
 * Support page func
 */
require get_template_directory() . '/inc/form-handler.php';
/**
 * Support page func
 */
require get_template_directory() . '/inc/support-search.php';
/**
 * Enable sav to media
 */
require get_template_directory() . '/inc/registration-login.php';
/**
 * Enable sav to media
 */
require get_template_directory() . '/inc/upload-user-ava.php';
/**
 * Enable sav to media
 */
require get_template_directory() . '/inc/enable-svg.php';
/**
 * Ajax comment
 */
require get_template_directory() . '/inc/ajax-comment.php';
/**
 * Custom image sizes
 */
require get_template_directory() . '/inc/image-sizes.php';
/**
 * Custom paginate_links
 */
require get_template_directory() . '/inc/custom-paginate_links.php';
/**
 * Shop Menu Walker
 */
require get_template_directory() . '/inc/walkers/shop_menu_walker.php';
/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue_script_style.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Register custom post types
 */
require get_template_directory() . '/inc/cpt-register.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
