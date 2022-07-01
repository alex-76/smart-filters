<?php

class YMC_admin_filters {

	public function __construct() {

		add_filter('ymc_filter_layouts',array($this, 'ymc_filter_layouts'), 10, 1);

	}

	public function ymc_filter_layouts() {

		return [
			"filter-layout1" => 'Default Filter',
			"filter-layout2" => 'Dropdown Filter',
			"filter-layout3" => 'Sidebar Filter',
			"filter-custom"  => 'Custom Filter',
		];
	}
}

new YMC_admin_filters();

