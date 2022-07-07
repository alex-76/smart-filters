<?php


class YMC_post_pagination {

	public function __construct() {}

	public function number($query, $paged, $type_pagination, $filter_id) {

		if ( !$query ) return;


		$prev_text = __('Prev','ymc-smart-filter');
		$next_text = __('Next','ymc-smart-filter');
		$prev_text = apply_filters('ymc_pagination_prev_text', $prev_text);
		$next_text = apply_filters('ymc_pagination_next_text', $next_text);

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
			echo "<ul id='ymc-layout-pagination' class='ymc-pagination pagination-" . $type_pagination ."'>";
			foreach ($paginate as $page):
				echo "<li>" . $page ."</li>";
			endforeach;
			echo "</ul>";
		endif;


	}

	public function load_more($query, $paged, $type_pagination, $filter_id) {

		// do something

		echo 'Button Load More Pagination';
	}

	public function scroll_infinity($query, $paged, $type_pagination, $filter_id) {

		// do something

		echo 'Scroll Infinity Pagination';
	}


}


