<?php

class YMC_shortcode {

	public function __construct() {

		add_shortcode("ymc_filter", array($this, "ymc_filter_apply"));

		//add_filter('tc_caf_post_layout_read_more',array($this,'tc_caf_post_layout_read_more'),5,2);
	}

	public function ymc_filter_apply( $atts ) {

		ob_start();

		$atts = shortcode_atts( [
				'id' => '',
			], $atts );

		$id = $atts['id'];

		require_once YMC_SMART_FILTER_DIR . '/front/front-variables.php';

		// Get Value CPT (posts, books, cars etc)
		if(get_post_meta($id, 'ymc_cpt_value', true)) {

			$ymc_cpt_value = get_post_meta($id,'ymc_cpt_value', true);
		}

		// Get CPT Plugin
		$ymc_cpt_filters = get_post_type($id); // ymc_filters


		wp_enqueue_style('ymc-smartf-front-style', YMC_SMART_FILTER_URL . '/front/assets/css/style.css', '', YMC_SMART_FILTER_VERSION);


		$output = '';

		$args = array(
			'post_type' => $ymc_cpt_value
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) :

			$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/post/" . $ymc_post_layout . ".php";

			if ( file_exists($filepath) ) {

				switch ( $ymc_post_layout ) :

					case  "post-layout1" :

						echo '<div class="container-'. $ymc_post_layout .'">';
						echo '<div class="post-entry">';

						include_once $filepath;

						echo '</div>';
						echo '</div>';

						break;

					case  "post-custom-layout" :

						$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/post/" . $ymc_post_layout . ".php";

						echo '<div class="container-'. $ymc_post_layout .'">';
						echo '<div class="post-entry">';

						include_once $filepath;

						echo '</div>';
						echo '</div>';

						break;

				endswitch;

			}
			else {
				echo "<div class='error-ymc'>" . esc_html('Filter Layout is not Available.', 'ymc-smart-filter') . "</div>";
			}


			wp_reset_query();

		endif;


		$output .= ob_get_contents();
		ob_end_clean();

		return $output;

	}

}

new YMC_shortcode();