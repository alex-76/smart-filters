<?php

class YMC_search_post {

	public function __construct() {
		add_action('wp_ajax_ymc_search_post', array($this, 'ymc_search_post'));
		add_action('wp_ajax_nopriv_ymc_search_post', array($this, 'search_post'));
	}

	public function ymc_search_post() {

		$search = $_POST['search'];
		$html = '';

		/*
		add_filter( 'posts_join', 'search_join' );
		add_filter( 'posts_where', 'search_where' );
		add_filter( 'posts_distinct', 'search_distinct' );

		$args = [
			'post_type' => 'post',
			'posts_per_page' => 7,
			'order' => 'DESC',
			'orderby' => 'date',
			'sentence' => true,
			's' => $search
		];

		$query = new WP_Query($args);

		if ($query->have_posts()) {

			ob_start();

			get_template_part('template-parts/news', 'hub', ['query' => $query]);

			$html .= ob_get_contents();
			ob_end_clean();


			//wp_reset_query();
		}
		*/

		$data = array(
			'data' => 'Data...'
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