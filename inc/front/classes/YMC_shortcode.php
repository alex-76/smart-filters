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

			if (is_array($tax_selected)) {
				$tax = implode(",", $tax_selected);
			}

			if(is_array($terms_selected)) {
				$terms = implode(',', $terms_selected);
			}

			// ===============================================
			// Need add options to Admin Panel Tab: Appearance
			// ===============================================
			$per_page = -1; // Count posts on page
			$type_pg = 'default'; // load-more, scroll-infinity

			echo '<div id="ymc-smart-container" 
					   class="ymc-smart-container ymc-' . $ymc_filter_layout . ' ymc-'. $ymc_post_layout . '"
					   data-params=\'{"cpt":"'.$ymc_cpt_value.'","tax":"'.$tax.'","terms":"'.$terms.'","type_pg":"'.$type_pg.'","per_page":"'.$per_page.'","post_layout":"'.$ymc_post_layout.'","filter_id":"'.$id.'"}\'>';

			// Enable / Disable Filters
			if ( $ymc_filter_status === 'on' ) {

				if ( $ymc_filter_layout ) {

					$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/filter/" . $ymc_filter_layout . ".php";

					if ( file_exists($filepath) ) {
						include_once $filepath;
					}
				}
			}

			echo '<div class="container-posts container-'. $ymc_post_layout .'"><div class="post-entry"></div></div>';

			echo '</div>'; // end ymc-layout-container
		}
		else {
			echo "<div class='ymc-smart-container'><div class='notice'>" . esc_html__('ID parameter is missing or invalid.', 'ymc-smart-filter') ."</div></div>";
		}


		$output .= ob_get_contents();
		ob_end_clean();

		return $output;

	}

}

new YMC_shortcode();