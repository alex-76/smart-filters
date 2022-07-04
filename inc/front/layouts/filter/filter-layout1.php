<?php
    defined('ABSPATH') or exit;
    // Add Style
    $filter_css = ".filter-layout1 .ymc-filter-entry .filter-item .filter-link {color:".$ymc_filter_text_color.";background-color:".$ymc_filter_bg_color.";}
                   .filter-layout1 .ymc-filter-entry .filter-item .filter-link.active {color:".$ymc_filter_active_color.";}";
    wp_add_inline_style($handle, $filter_css);
?>

<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">
	<ul class="ymc-filter-entry">
		<?php

			if ( $terms_selected ) {

				echo '<li class="filter-item"><a class="filter-link active" href="#" >' . __("All",'ymc-smart-filter') . '</a></li>';

                foreach ($terms_selected as $key => $term) {

	                $term_data = get_term($term);

	                if ($term_data) {

		                $cl = '';
		                $data_id = esc_attr($term_data->term_id);

		                echo "<li class='filter-item'>
                              <a class='filter-link' href='#' data-id='" . esc_attr($data_id) . "'>" . esc_html($term_data->name) . "</a>
                              </li>";
	                }
                }
			}
		?>
	</ul>
</div>









