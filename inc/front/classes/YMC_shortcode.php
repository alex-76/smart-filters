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

		$output = '';

		require_once YMC_SMART_FILTER_DIR . '/front/classes/YMC_front_filters.php';
		require_once YMC_SMART_FILTER_DIR . '/front/front-variables.php';

		$handle = "ymc-smartf-style-" . $ymc_filter_layout;

		wp_enqueue_style($handle, YMC_SMART_FILTER_URL . '/front/assets/css/style.css', '', YMC_SMART_FILTER_VERSION);
		wp_enqueue_script('ymc-smart-frontend-scripts', YMC_SMART_FILTER_URL . '/front/assets/js/script.js', array('jquery'), YMC_SMART_FILTER_VERSION);
		wp_localize_script( 'ymc-smart-frontend-scripts', '_global_object',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('custom_ajax_nonce'),
				'current_page' => 1,
				'path' => YMC_SMART_FILTER_URL
			));


		$ymc_post_type = get_post_type($id);

		// $ymc_post_type - ymc_filters
		// $ymc_cpt_value - post, book, car etc.
		// $ymc_post_layout - post-layout1
		// $ymc_filter_layout - filter-layout1


		if ( !empty($id) && $ymc_post_type === 'ymc_filters' ) {

			if (is_array($tax)) {
				$tax = implode(",", $tax);
			}

			echo '<div id="ymc-smart-container" 
					   class="ymc-smart-container ymc-' . $ymc_filter_layout . ' ymc-'. $ymc_post_layout . '"
					   data-params=\'{"cpt":"'.$ymc_cpt_value.'","tax":"'.$tax.'","terms":"'.$term.'","per_page":"4"}\'
					   >';

			if ( $ymc_filter_status === 'on' ) {

				if ( $ymc_filter_layout ) {

					$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/filter/" . $ymc_filter_layout . ".php";

					if ( file_exists($filepath) ) {
						include_once $filepath;
					}
				}
			}

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

						case  "post-layout2" :

							echo '<div class="container-'. $ymc_post_layout .'">';
							echo '<div class="post-entry">';

							include_once $filepath;

							echo '</div>';
							echo '</div>';

							break;

						case  "post-layout3" :

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
					echo "<div class='error-ymc'>" . esc_html('Filter layout is not available.', 'ymc-smart-filter') . "</div>";
				}

				wp_reset_query();

			endif;

			echo '</div>'; // end ymc-layout-container
		}


		$output .= ob_get_contents();
		ob_end_clean();

		return $output;

	}

}

new YMC_shortcode();