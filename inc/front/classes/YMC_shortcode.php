<?php

class YMC_shortcode {

	public function __construct() {

		add_shortcode("ymc_filter", array($this, "ymc_filter_apply"));

		//add_filter('tc_caf_post_layout_read_more',array($this,'tc_caf_post_layout_read_more'),5,2);
	}

	public function ymc_filter_apply( $atts ) {

		ob_start();

		require_once YMC_SMART_FILTER_DIR . '/front/front-variables.php';

		$atts = shortcode_atts( [
				'id' => '',
			], $atts );

		$id = $atts['id'];

		// Get Value CPT (posts, books, cars etc)
		if(get_post_meta($id, 'ymc_cpt_value', true)) {

			$ymc_cpt_value = get_post_meta($id,'ymc_cpt_value', true);
		}

		// Get CPT Plugin
		$ymc_cpt_filters = get_post_type($id); // ymc_filters

		//wp_enqueue_style('tc-caf-' . $caf_post_layout, TC_CAF_URL . 'assets/css/post/"' . $caf_post_layout . '".min.css', '', TC_CAF_PLUGIN_VERSION);


		// EDIT CODE =========>

		$output = '';
		$output .= '<div class="container-temp">';

		$args = array(
			'post_type' => $ymc_cpt_value
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) :

			while ($query->have_posts()) : $query->the_post();

				if(get_post_meta($id, 'ymc_post_layout', true) === 'post-custom-layout') {
					// $layouts, $post_id, $cpt_id
					$output .= apply_filters('ymc_post_custom_layout', $layouts, get_the_ID(), $id );
				}
				else {
					$output .= '<article><h2 style="font-size: 28px;">' . get_the_title(get_the_ID()) . get_post_meta($id, 'ymc_post_layout', true) .'</h2>
					<p>'.wp_trim_words(get_the_content(get_the_ID()), 25).'</p>
					<a href="#">More...</a>
					</article>';
				}

			endwhile;

			wp_reset_query();

		endif;



		$output .= '</div>';

		//return  $filter_layouts;




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



		$output .= ob_get_contents();
		ob_end_clean();

		return $output;

	}

}

new YMC_shortcode();