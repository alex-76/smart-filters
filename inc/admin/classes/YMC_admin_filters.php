<?php

class YMC_admin_filters {

	public function __construct() {

		add_filter('ymc_filter_layouts',array($this, 'ymc_filter_layouts'), 3, 1);
		add_filter('ymc_post_layouts', array($this, 'ymc_post_layouts'), 3, 1);
		add_filter('ymc_pagination_type', array($this, 'ymc_pagination_type'), 3, 1);
		add_filter('ymc_order_post_by', array($this, 'ymc_order_post_by'), 3, 1);

	}

	public function ymc_filter_layouts($layouts) {

		$layouts = [
			"filter-layout1" => 'Simple Posts Filter',
			"filter-layout2" => 'Taxonomy Filter',
			"filter-layout3" => 'Dropdown Filter'
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

	public function ymc_pagination_type($type) {
		$type = [
			"default" => 'Number',
			"load-more" => 'Load more',
			"scroll-infinity" => 'Scroll infinity'
		];

		return $type;
	}

	public function ymc_order_post_by($order) {
		$order = [
			"title" => 'Title',
			"name" =>  'Name',
			"date" =>  'Date',
			"ID" =>    'ID',
			"author" => 'Author'
		];

		return $order;
	}



}

new YMC_admin_filters();

