<?php

    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');

    function fix_svg_thumb_display() {
        echo '<style>
        td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
          width: 100% !important; 
          height: auto !important; 
        }</style>
      ';
    }
    add_action('admin_head', 'fix_svg_thumb_display');