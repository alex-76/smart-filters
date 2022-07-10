<?php
defined('ABSPATH') or exit;

// Add Style

$ymc_post_text_color = !empty($ymc_post_text_color) ? "color:".$ymc_post_text_color.";" : '';
$ymc_post_bg_color   = !empty($ymc_post_bg_color) ? "background-color:".$ymc_post_bg_color.";" : '';
$ymc_post_active_color = !empty($ymc_post_active_color) ? "color:".$ymc_post_active_color.";" : '';


$post_css = "#ymc-smart-filter-container .container-posts .post-entry {".$ymc_post_text_color."}
#ymc-smart-filter-container .container-posts .post-entry .ymc-post-layout1 {".$ymc_post_bg_color."}
#ymc-smart-filter-container .container-posts .post-entry.post-layout1 .ymc-post-layout1 .read-more a {".$ymc_post_active_color."}
#ymc-smart-filter-container .ymc-pagination.pagination-default li a {".$ymc_post_text_color . $ymc_post_bg_color."}
#ymc-smart-filter-container .pagination-load-more a {".$ymc_post_text_color . $ymc_post_bg_color."}";

wp_add_inline_style($handle, $post_css);



