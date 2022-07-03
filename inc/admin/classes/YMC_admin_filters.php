<?php

class YMC_admin_filters {

	public function __construct() {

		add_filter('ymc_filter_layouts',array($this, 'ymc_filter_layouts'), 10, 1);
		add_filter('ymc_post_layouts', array($this, 'ymc_post_layouts'), 10, 1);

	}

	public function ymc_filter_layouts($layouts) {

		$layouts = [
			"filter-layout1" => 'Default Filter',
			"filter-layout2" => 'Dropdown Filter',
			"filter-layout3" => 'Sidebar Filter',
			"filter-custom-layout"  => 'Custom Filter',
		];

		return $layouts;
	}

	public function ymc_post_layouts($layouts) {

		$layouts = [
			"post-layout1" => 'Simple Blogs',
			"post-layout2" => 'Boxed Title',
			"post-layout3" => 'Glossy look',
			"post-custom-layout"  => 'Custom Post'
		];

		return $layouts;
	}



}

new YMC_admin_filters();
