<?php

class YMC_admin_ajax {

	public function __construct() {

		add_action('wp_ajax_ymc_get_taxonomy',array($this,'ymc_get_taxonomy'));
		add_action("wp_ajax_nopriv_ymc_get_taxonomy",array($this,"ymc_get_taxonomy"));
		add_action('wp_ajax_ymc_get_terms',array($this,'ymc_get_terms'));
		add_action("wp_ajax_nopriv_ymc_get_terms", array($this,"ymc_get_terms"));

	}

	public function ymc_get_taxonomy() {

		if (!wp_verify_nonce($_POST['nonce_code'], 'custom_ajax_nonce')) exit;

		if(isset($_POST["cpt"])) {
			$cpt = sanitize_text_field($_POST["cpt"]);
		}

		$data = get_object_taxonomies($cpt);

		$data = array(
			'data' => $data
		);

		wp_send_json($data);

	}

	public function ymc_get_terms() {

		if (!wp_verify_nonce($_POST['nonce_code'], 'custom_ajax_nonce')) exit;

		if(isset($_POST["taxonomy"])) {
			$taxonomy = sanitize_text_field($_POST["taxonomy"]);
		}
		if($taxonomy) {
			$terms = get_terms([
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
			]);
			$data['terms'] = $terms;
		}

		$data = array(
			'data' => $data
		);

		wp_send_json($data);

	}

}

new YMC_admin_ajax();