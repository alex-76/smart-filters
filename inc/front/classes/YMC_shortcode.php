<?php

class YMC_shortcode {

	public function __construct() {

		add_shortcode("ymc_filter", array($this, "ymc_filter_apply"));
		//add_filter('tc_caf_post_layout_read_more',array($this,'tc_caf_post_layout_read_more'),5,2);
	}

	public function ymc_filter_apply( $atts ) {

		require_once YMC_SMART_FILTER_DIR . '/front/variables.php';

		$atts = shortcode_atts( [
			'id' => '',
			], $atts );

		$id = $atts['id'];

		// Get Value CPT
		if(get_post_meta($id, 'ymc_cpt_value')) {

			$ymc_cpt_value = get_post_meta($id,'ymc_cpt_value', true);
		}




//		if(get_post_meta($id,'ymc_cpt_value')) {
//
//			$ymc_cpt_value = get_post_meta($id,'ymc_cpt_value',true);
//		}
//		var_dump($ymc_cpt_value); //post, book, car
//
//		$pt = get_post_type($id);
//		var_dump($pt); // ymc_filters
//
//		if(get_post_meta($id, 'ymc_taxonomy')) {
//			$tax_sel = get_post_meta($id, 'ymc_taxonomy', true);
//		}
//		var_dump($tax_sel);
//
//		if(get_post_meta($id, 'ymc_terms')) {
//			$terms_sel = get_post_meta($id, 'ymc_terms', true);
//		}
//		var_dump($terms_sel);



		return 'Test...' . $ymc_cpt_value;

	}

}

new YMC_shortcode();