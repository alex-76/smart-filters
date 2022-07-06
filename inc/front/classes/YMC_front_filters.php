<?php

class YMC_front_filters {

	public function __construct() {

		add_filter('ymc_filter_posts_order_by', array($this, 'ymc_filter_posts_order_by'), 10, 1);
		add_filter('ymc_filter_posts_order', array($this, 'ymc_filter_posts_order'), 10, 1);

	}

	public function ymc_filter_posts_order_by($default) {
		return 'title';
	}
	public function ymc_filter_posts_order($default) {
		return 'asc';
	}

}

new YMC_front_filters();