<?php

class YMC_shortcode {

	public function __construct() {
		add_shortcode("ymc_filter", array($this, "ymc_filter_apply"));
		//add_filter('tc_caf_post_layout_read_more',array($this,'tc_caf_post_layout_read_more'),5,2);
	}

	public function ymc_filter_apply( $atts ) {

		return 'Test...';

	}

}

new YMC_shortcode();