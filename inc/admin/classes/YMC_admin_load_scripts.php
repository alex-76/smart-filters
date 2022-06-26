<?php

class YMC_admin_load_scripts {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array($this,'ymc_smartf_embedCssJs'));
	}

	public function ymc_smartf_embedCssJs() {

		wp_enqueue_style( 'ymc-smartf_admin-style', YMC_SMART_FILTER_URL . '/admin/assets/css/admin.css');
		wp_enqueue_script( 'ymc-smartf-admin-script', YMC_SMART_FILTER_URL . '/admin/assets/js/admin.js', array( 'jquery' ) );

	}

}

new YMC_admin_load_scripts();