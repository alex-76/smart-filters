<?php


class YMC_post_pagination {

	public function __construct() {}

	public function number($query, $paged, $type_pagination, $filter_id) {

		if ( ! $query ) return;

		$output = '';

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
			$output .= "<ul id='ymc-layout-pagination' class='ymc-pagination pagination-" . $type_pagination ."'>";
			foreach ($paginate as $page):
				$output .= "<li>" . $page ."</li>";
			endforeach;
			$output .= "</ul>";
		endif;

		return $output;
	}

	public function load_more($query, $paged, $type_pagination, $filter_id) {

		if ( ! $query ) return;

		// do something

		$output = '';

		$load_more = apply_filters('ymc_pagination_load_more', $load_more);

		if( $query->max_num_pages > 1 ) :
			$output .= "<div id='ymc-layout-pagination' class='ymc-pagination pagination-" . $type_pagination ."'>";
			$output .= "<a class='btn-load' href='#'>". $load_more ."</a>";
			$output .= "</div>";
		endif;

		return $output;
	}

	public function scroll_infinity($query, $paged, $type_pagination, $filter_id) {}

}


