<?php

class YMC_search_post {

	public function __construct() {
		add_action('wp_ajax_ymc_search_post', array($this, 'ymc_search_post'));
		add_action('wp_ajax_nopriv_ymc_search_post', array($this, 'search_post'));
	}

	public function ymc_search_post() {

		if (!wp_verify_nonce($_POST['nonce_code'], 'custom_ajax_nonce')) exit;


		$html = '';

		$phrase    = $_POST['phrase'];
		$cpt       = $_POST['cpt'];
		$id        = $_POST['id'];
		$per_page  = $_POST['per_page'];
		$total = 0;

		//add_filter( 'posts_join', 'search_join' );
		//add_filter( 'posts_where', 'search_where' );
		//add_filter( 'posts_distinct', 'search_distinct' );

		require_once YMC_SMART_FILTER_DIR . '/front/classes/YMC_front_filters.php';
		require_once YMC_SMART_FILTER_DIR . '/front/front-variables.php';



		$default_order_by = apply_filters('ymc_filter_posts_order_by', $ymc_order_post_by);
		$default_order    = apply_filters('ymc_filter_posts_order', $ymc_order_post_type);

		$args = [
			'post_type' => $cpt,
			'posts_per_page' => $per_page,
			'orderby' => $default_order_by,
			'order' => $default_order,
			'sentence' => true,
			's' => $phrase
		];

		$query = new WP_Query($args);

		if ($query->have_posts()) {

			$total = $query->found_posts;

			//ob_start();
			//get_template_part('template-parts/news', 'hub', ['query' => $query]);
			//$html .= ob_get_contents();
			//ob_end_clean();
			//wp_reset_query();
		}


		$data = array(
			'data' => 'Data...',
			'total' => $total
		);

		wp_send_json($data);

	}

	private function search_join( $join ){

		global $wpdb;

		$join .= " LEFT JOIN $wpdb->postmeta ON ID = $wpdb->postmeta.post_id ";

		return $join;
	}

	private function search_where( $where ) {

		global $wpdb;

		$where = preg_replace(
			"/\(\s*$wpdb->posts.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"($wpdb->posts.post_title LIKE $1) OR ($wpdb->postmeta.meta_value LIKE $1)", $where );


		return $where;
	}

	private function search_distinct( $where ) {

		return  'DISTINCT' ;
	}

}

new YMC_search_post();