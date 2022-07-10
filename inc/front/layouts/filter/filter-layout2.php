<?php
defined('ABSPATH') or exit;
// Add Style
$filter_css = "#ymc-smart-filter-container .filter-layout2 .filter-entry .filter-item .filter-link {color:".$ymc_filter_text_color.";background-color:".$ymc_filter_bg_color.";}
               #ymc-smart-filter-container .filter-layout2 .filter-entry .filter-item .filter-link.active {color:".$ymc_filter_active_color.";}";
wp_add_inline_style($handle, $filter_css);
?>


<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

	<ul class="filter-entry">

		<?php

		$type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

		if ( is_array($terms_selected) ) {

			( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected);

			echo '<li class="filter-item group-filters"><a class="filter-link all active" href="#" data-id="' . esc_attr($terms) . '">' . __("All",'ymc-smart-filter') . '</a></li>';

			$arr_taxonomies = [];
            foreach ($terms_selected as $term) {
	            $arr_taxonomies[] = get_term( $term )->taxonomy;
            }
			$arr_taxonomies = array_unique($arr_taxonomies);

            foreach ($arr_taxonomies as $tax) {

                $group_terms = '';

	            echo '<li class="group-filters"><h3 class="name-tax">'.$tax .'</h3><ul class="sub-filters">';

	            foreach ($terms_selected as $term) {

                    if( $tax === get_term( $term )->taxonomy ) {
	                    echo  "<li class='filter-item'><a class='filter-link ". $type_multiple ."' href='#' data-termid='" . esc_attr($term) . "'>" . esc_html(get_term( $term )->name) . "</a></li>";
                    }
	            }

                echo '</ul></li>';
            }
		}
		?>

	</ul>

	<?php do_action("ymc_after_filter_layout"); ?>

</div>
