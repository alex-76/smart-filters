<?php

class YMC_get_filter_posts {

	public function __construct() {
		add_action('wp_ajax_ymc_get_posts', array($this, 'get_filter_posts'));
		add_action('wp_ajax_nopriv_ymc_get_posts', array($this, 'get_filter_posts'));
	}


	public function get_filter_posts() {
		// Get posts
		$data = array(
			'data' => 'posts...'
		);

		wp_send_json($data);
	}
}

new YMC_get_filter_posts();