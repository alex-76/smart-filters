<?php

class YMC_admin_load_scripts {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array($this,'ymc_smartf_embedCssJs'));
	}

	public function ymc_smartf_embedCssJs() {

		wp_enqueue_style( 'ymc-smartf_admin-style', YMC_SMART_FILTER_URL . '/admin/assets/css/admin.css');
		wp_enqueue_script( 'ymc-smartf-admin-script', YMC_SMART_FILTER_URL . '/admin/assets/js/admin.js', array( 'jquery' ) );
		wp_localize_script( 'ymc-smartf-admin-script', '_global_object',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('custom_ajax_nonce'),
				'current_page' => 1,
				'path' => get_site_url(),
			));

	}

}

new YMC_admin_load_scripts();