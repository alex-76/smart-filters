# YMC SMART FILTER
Plugin YMC Smart Filters WP

####
List Filters:

add_filter('ymc_pagination_prev_text', array($this, 'ymc_pagination_prev_text'), 3, 1);

add_filter('ymc_pagination_next_text', array($this, 'ymc_pagination_next_text'), 3, 1);

add_filter('ymc_pagination_load_more', array($this, 'ymc_pagination_load_more'), 3, 1);

add_filter('ymc_post_date_format', array($this, 'ymc_post_date_format'), 3, 1);

add_filter('ymc_post_excerpt_length', array($this, 'ymc_post_excerpt_length'), 3, 1);

add_filter('ymc_post_read_more', array($this, 'ymc_post_read_more'), 3, 1);

=============================

Layouts:
Custom Post Layout

@parmas: 

$layouts - HTML markup

$post_id - Post ID

$cpt_id - CPT ID

add_filter('ymc_post_custom_layout', 'custom_post_layout', 10, 3);

============================

Custom Filter Layout
@parmas:

$layouts - HTML markup 

$terms_selected - Ids terms

$tax - slug taxonomies

$ymc_multiple_filter - multiple / single

add_filter('ymc_filter_custom_layout', 'ymc_filter_custom_layout', 10, 4);

============================

Add Hooks:

Add custom content before or after filters panel

do_action("ymc_before_filter_layout");

do_action("ymc_after_filter_layout");


