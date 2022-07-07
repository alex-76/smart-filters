<?php

class YMC_front_filters {

	public function __construct() {

		add_filter('ymc_filter_posts_order_by', array($this, 'ymc_filter_posts_order_by'), 10, 1);
		add_filter('ymc_filter_posts_order', array($this, 'ymc_filter_posts_order'), 10, 1);
		add_filter('ymc_pagination_prev_text', array($this, 'ymc_pagination_prev_text'), 10, 1);
		add_filter('ymc_pagination_next_text', array($this, 'ymc_pagination_next_text'), 10, 1);
		add_filter('ymc_post_date_format', array($this, 'ymc_post_date_format'), 10, 1);
		add_filter('ymc_post_excerpt_length', array($this, 'ymc_post_excerpt_length'), 10, 1);
		add_filter('ymc_post_read_more', array($this, 'ymc_post_read_more'), 10, 1);

	}

	// Order By WP_Query
	public function ymc_filter_posts_order_by($default) {
		return 'title';
	}

	// Order WP_Query
	public function ymc_filter_posts_order($default) {
		return 'asc';
	}

	// Text prev button pagination
	public function ymc_pagination_prev_text($default) {
		return 'Prev';
	}

	// Text next button pagination
	public function ymc_pagination_next_text($default) {
		return 'Next';
	}

	// Date publish post
	public function ymc_post_date_format($default) {
		return 'd, M Y';
	}

	// Date excerpt post
	public function ymc_post_excerpt_length($default) {
		return 30;
	}

	// Button Read More
	public function ymc_post_read_more($default) {
		return 'Read More';
	}


}

new YMC_front_filters();