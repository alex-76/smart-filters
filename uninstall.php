<?php
/**
 * Uninstall plugin
 * Trigger Uninstall process only if WP_UNINSTALL_PLUGIN is defined
 */

if(!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

// Delete data from table wp_postmeta
$wpdb->get_results('DELETE FROM wp_postmeta WHERE meta_key IN (
                                  "ymc_cpt_value", 
                                  "ymc_taxonomy", 
                                  "ymc_terms", 
                                  "ymc_filter_status", 
                                  "ymc_filter_layout",
                                  "ymc_filter_text_color",
                                  "ymc_filter_bg_color",
                                  "ymc_filter_active_color",
                                  "ymc_post_layout",
                                  "ymc_post_text_color",
                                  "ymc_post_bg_color",
                                  "ymc_post_active_color",
                                  "ymc_multiple_filter",
                                  "ymc_empty_post_result",
                                  "ymc_link_target",
                                  "ymc_per_page",
                                  "ymc_pagination_type",
                                  "ymc_sort_terms",
                                  "ymc_order_post_by",
                                  "ymc_order_post_type",
                                  "ymc_special_post_class",
                                  "ymc_filter_font",
                                  "ymc_post_font",
                                  "ymc_filter_search_status",  
                                  "ymc_search_text_button"                                          
                                  )');


// Delete data from table wp_posts
$wpdb->get_results('DELETE FROM wp_posts WHERE post_type IN ("ymc_filters")');













