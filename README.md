# smart-filters
Plugin YMC Smart Filters WP

####
Filters:
add_filter('ymc_pagination_prev_text', array($this, 'ymc_pagination_prev_text'), 3, 1);
add_filter('ymc_pagination_next_text', array($this, 'ymc_pagination_next_text'), 3, 1);
add_filter('ymc_pagination_load_more', array($this, 'ymc_pagination_load_more'), 3, 1);
add_filter('ymc_post_date_format', array($this, 'ymc_post_date_format'), 3, 1);
add_filter('ymc_post_excerpt_length', array($this, 'ymc_post_excerpt_length'), 3, 1);
add_filter('ymc_post_read_more', array($this, 'ymc_post_read_more'), 3, 1);



