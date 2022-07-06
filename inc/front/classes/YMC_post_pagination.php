<?php


class YMC_post_pagination {

	public function __construct() {}

	public function number($query, $paged, $post_layout, $type_pagination, $filter_id) {

		if (!$query) {
			return;
		}

		//echo $paged;
		//echo $post_layout;
		//echo $type_pagination;
		//echo $filter_id;
		//echo $query->max_num_pages;


		$prev_text = 'Prev';
		$next_text = 'Next';
		//$prev_text = apply_filters('tc_caf_filter_prev_text', $prev_text, $filter_id);
		//$next_text = apply_filters('tc_caf_filter_next_text', $next_text, $filter_id);


		$paginate = paginate_links([
			'base' => '%_%',
			'type' => 'array',
			'total' => $query->max_num_pages,
			'format' => '#page=%#%',
			'current' => max(1, $paged),
			'prev_text' => $prev_text,
			'next_text' => $next_text,
		]);

		if ($query->max_num_pages > 1):
			echo "<ul id='ymc-layout-pagination' class='ymc-pagination numeric-pagination " . $post_layout ."'>";
			foreach ($paginate as $page):
				echo "<li>" . $page ."</li>";
			endforeach;
			echo "</ul>";
		endif;


	}

	public function load_more() {

		return 'Load More Pagination';
	}

	public function scroll_infinity() {

		return 'Scroll Imfinity Pagination';
	}


}


