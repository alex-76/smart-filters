<?php

class YMC_get_filter_posts {

	public function __construct() {
		add_action('wp_ajax_ymc_get_posts', array($this, 'get_filter_posts'));
		add_action('wp_ajax_nopriv_ymc_get_posts', array($this, 'get_filter_posts'));
	}


	public function get_filter_posts() {

		if (!wp_verify_nonce($_POST['nonce_code'], 'custom_ajax_nonce')) exit;

		$posted_data = $_POST['params'];
		$temp_data = str_replace("\\", "", $posted_data);
		$clean_data = json_decode($temp_data, true);

		$taxonomy  = sanitize_text_field($clean_data['tax']);
		$post_type = sanitize_text_field($clean_data['cpt']);
		$term     = sanitize_text_field($clean_data['terms']);
		$per_page = (int) $clean_data['per_page'];

		$terms = explode(',', $term);

		/*
		if (!is_array($terms)):
			$response = [
				'status' => 501,
				'message' => 'Term doesn\'t exist',
				'content' => 0,
			];
			die(json_encode($response));
		else:
			if ($terms == 'all'):
				$tax_qry[] = [
					'taxonomy' => $tax,
					'field' => 'term_id',
					'terms' => $terms,
					'operator' => 'IN',
				];
			else:
				$tax_qry[] = [
					'taxonomy' => $tax,
					'field' => 'term_id',
					'terms' => $terms,
				];
			endif;
		endif;
		*/




		// Get posts
		$data = array(
			'data' => $terms
		);

		wp_send_json($data);
	}
}

new YMC_get_filter_posts();