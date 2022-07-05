<?php

class YMC_get_filter_posts {

	public function __construct() {
		add_action('wp_ajax_ymc_get_posts', array($this, 'get_filter_posts'));
		add_action('wp_ajax_nopriv_ymc_get_posts', array($this, 'get_filter_posts'));
	}


	public function get_filter_posts() {

		if (!wp_verify_nonce($_POST['nonce_code'], 'custom_ajax_nonce')) exit;

		$output  = '';
		$message = '';

		$posted_data = $_POST['params'];
		$temp_data = str_replace("\\", "", $posted_data);
		$clean_data = json_decode($temp_data, true);

		$post_type = $clean_data['cpt'];
		$taxonomy  = $clean_data['tax'];
		$terms     = $clean_data['terms'];
		$per_page  = (int) $clean_data['per_page'];
		$post_layout = $clean_data['post_layout'];
		$filter_id = $clean_data['filter_id'];
		$term_ids  = $_POST['ids'];


		$taxonomy = !empty($taxonomy) ? explode(',', $taxonomy) : false;
		$terms    = !empty($terms) ? explode(',', $terms) : false;


		if ( is_array($taxonomy) && is_array($terms) && empty($term_ids) ) :

			foreach ($taxonomy as $tax) :

				foreach ($terms as $term) :

					$arr = explode("-", $term);

					if($tax === $arr[0]) :
						$term_id[] = (int) $arr[1];
					endif;

				endforeach;

				if( count($term_id) > 0 ) :

					$tax_qry[] = [
						'taxonomy' => $tax,
						'field' => 'term_id',
						'terms' => $term_id
					];

				endif;

				$term_id = [];

			endforeach;

		else :

			$tx = get_term( $term_ids )->taxonomy;

			$tax_qry[] = [
				'taxonomy' => get_term( $term_ids )->taxonomy,
				'field' => 'term_id',
				'terms' => explode(',', $term_ids)
			];

		endif;




		$args = [
			//'paged' => $page,
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'tax_query' => $tax_qry,
			//'orderby' => $default_order_by,
			//'order' => $default_order,
		];

		$query = new WP_Query($args);

		ob_start();

		if ($query->have_posts()) :

			$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/post/" . $post_layout . ".php";

			if ( file_exists($filepath) ) {

				switch ( $post_layout ) :

					case  "post-layout1" :

						echo '<div class="wrapper-posts container-'. $post_layout .'">';
						echo '<div class="post-entry">';

						include_once $filepath;

						echo '</div>';
						echo '</div>';

						break;

					case  "post-layout2" :

						echo '<div class="wrapper-posts container-'. $post_layout .'">';
						echo '<div class="post-entry">';

						include_once $filepath;

						echo '</div>';
						echo '</div>';

						break;

					case  "post-layout3" :

						echo '<div class="wrapper-posts container-'. $post_layout .'">';
						echo '<div class="post-entry">';

						include_once $filepath;

						echo '</div>';
						echo '</div>';

						break;

					case  "post-custom-layout" :

						$filepath = YMC_SMART_FILTER_DIR . "/front/layouts/post/" . $post_layout . ".php";

						echo '<div class="wrapper-posts container-'. $post_layout .'">';
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

		endif;

		$output .= ob_get_contents();
		ob_end_clean();


		$data = array(
			'data' => $output,
			'found' => $query->found_posts,
			'message' => $message,
			'post_type' => $post_type,
			'tax' => $taxonomy,
			'term' => $tax_qry,
			'term_ids' => $term_ids,
			'tx' => $tx
		);

		wp_send_json($data);
	}
}

new YMC_get_filter_posts();