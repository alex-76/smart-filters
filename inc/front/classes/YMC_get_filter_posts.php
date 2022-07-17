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

		// Get data from json
		$post_type = $clean_data['cpt'];
		$taxonomy  = $clean_data['tax'];
		$terms     = $clean_data['terms'];
		$per_page  = $clean_data['per_page'];
		$post_layout = $clean_data['post_layout'];
		$filter_id = $clean_data['filter_id'];
		$type_pagination = $clean_data['type_pg'];

		$paged = (int) $_POST['paged'];

		$id = $filter_id;

		require_once YMC_SMART_FILTER_DIR . '/front/classes/YMC_front_filters.php';
		require_once YMC_SMART_FILTER_DIR . '/front/front-variables.php';

		$default_order_by = apply_filters('ymc_filter_posts_order_by', $ymc_order_post_by);
		$default_order    = apply_filters('ymc_filter_posts_order', $ymc_order_post_type);

		// Convert Taxonomy & Terms to Array
		$taxonomy = !empty($taxonomy) ? explode(',', $taxonomy) : false;
		$terms    = !empty($terms)    ? explode(',', $terms)    : false;


		if ( is_array($taxonomy) && is_array($terms) ) :

			foreach ($taxonomy as $tax) :

				foreach ($terms as $term) :

					if($tax === get_term( $term )->taxonomy) :
						$term_id[] = (int) $term;
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

		// If selected term
		/*
		else :

			foreach ($taxonomy as $tax) :

				foreach ($term_ids as $term) :

					if($tax === get_term( $term )->taxonomy) :
						$term_id[] = (int) $term;
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
		*/
		endif;


		$args = [
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => $per_page,
			'tax_query' => $tax_qry,
			'paged' => $paged,
			'orderby' => $default_order_by,
			'order' => $default_order,
		];

		$query = new WP_Query($args);

		ob_start();

		if ( $query->have_posts() ) :

			$file_layout = YMC_SMART_FILTER_DIR . "/front/layouts/post/" . $post_layout . ".php";
			require_once YMC_SMART_FILTER_DIR . "/front/classes/YMC_post_pagination.php";


			// Add Layouts posts
			if ( file_exists($file_layout) ) :

				switch ( $post_layout ) :

					case  "post-layout1" :

						include_once $file_layout;

						break;

					case  "post-layout2" :

						include_once $file_layout;

						break;

					case  "post-layout3" :

						include_once $file_layout;

						break;

					case  "post-custom-layout" :

						include_once $file_layout;

						break;

				endswitch;

				$message = 'OK';

			else :

				echo "<div class='ymc-error'>" . esc_html('Filter layout is not available.', 'ymc-smart-filter') . "</div>";
				$message = 'Filter layout is not available';

			endif;

			// Add Pagination
			require_once YMC_SMART_FILTER_DIR . "/front/pagination/pagination.php";

		else :

			echo "<div class='ymc-notification'>" . esc_html($ymc_empty_post_result, 'ymc-smart-filter') . "</div>";
			$message = 'No posts found';

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
			'max_num_pages' => $query->max_num_pages,
			'get_current_posts' => ($query->found_posts - $paged * $per_page),
			'pagin' => !empty($pagin) ? $pagin : ''
		);

		wp_send_json($data);
	}
}

new YMC_get_filter_posts();