<?php

class YMC_search_post {

	public function __construct() {}

	public function search_post() {

		$search = $_POST['search'];
		$html = '';

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

	}

	function search_join( $join ){

		global $wpdb;

		$join .= " LEFT JOIN $wpdb->postmeta ON ID = $wpdb->postmeta.post_id ";

		return $join;
	}

	function search_where( $where ) {

		global $wpdb;

		$where = preg_replace(
			"/\(\s*$wpdb->posts.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"($wpdb->posts.post_title LIKE $1) OR ($wpdb->postmeta.meta_value LIKE $1)", $where );


		return $where;
	}

	function search_distinct( $where ) {

		return  'DISTINCT' ;
	}





}