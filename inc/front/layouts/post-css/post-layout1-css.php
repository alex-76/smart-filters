<?php
defined('ABSPATH') or exit;

// Add Style
$post_css = "#ymc-smart-container .container-posts .post-entry {color:".$ymc_post_text_color.";}
#ymc-smart-container .container-posts .post-entry .ymc-post-layout1 {background-color:".$ymc_post_bg_color.";}
#ymc-smart-container .container-posts .post-entry.post-layout1 .ymc-post-layout1 .read-more a {color:".$ymc_post_active_color.";}
#ymc-smart-container .ymc-pagination.pagination-default li a {color:".$ymc_post_text_color.";background-color:".$ymc_post_bg_color.";}
#ymc-smart-container .pagination-load-more a {color:".$ymc_post_text_color.";background-color:".$ymc_post_bg_color.";}";

wp_add_inline_style($handle, $post_css);



