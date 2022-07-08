<?php

class YMC_admin_filters {

	public function __construct() {

		add_filter('ymc_filter_layouts',array($this, 'ymc_filter_layouts'), 10, 1);
		add_filter('ymc_post_layouts', array($this, 'ymc_post_layouts'), 10, 1);

	}

	public function ymc_filter_layouts($layouts) {

		$layouts = [
			"filter-layout1" => 'Default',
			"filter-layout2" => 'Dropdown 1',
			"filter-layout3" => 'Dropdown 2'
		];

		return $layouts;
	}

	public function ymc_post_layouts($layouts) {

		$layouts = [
			"post-layout1" => 'Default',
			"post-layout2" => 'Layout 2',
			"post-layout3" => 'Layout 3',
			"post-custom-layout"  => 'Custom Layout'
		];

		return $layouts;
	}



}

new YMC_admin_filters();

