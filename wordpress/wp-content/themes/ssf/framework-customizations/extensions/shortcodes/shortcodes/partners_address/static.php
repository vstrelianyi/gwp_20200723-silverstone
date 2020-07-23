<?php if (!defined('FW')) die('Forbidden');

//$p_add = fw_get_db_settings_option('partners_address');
//
//if(!empty($p_add) && is_array($p_add)){
//    foreach ($p_add as $location){
//        if(!empty($location['city'])) {
//            $locations[] = $location['city'];
//        }
//    }
//}
//
//if(!empty($locations)){
//    wp_localize_script('search-partner','partner_locations', $locations);
//}

wp_register_script('search-partner', get_template_directory_uri() .'/js/search-partner.js', array('scripts.min'), null, true );
wp_enqueue_script('search-partner');
