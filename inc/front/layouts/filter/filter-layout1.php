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

			if ( $term_obj ) {

				$trm1 = implode(',', $term_all_sel);

				echo '<li class="filter-item"><a class="filter-link active" href="#" data-id="' . esc_attr($trm1) . '">' . __("All",'ymc-smart-filter') . '</a></li>';

                foreach ($term_obj as $term) {

                    echo "<li class='filter-item'>
                          <a class='filter-link' href='#' data-id='" . esc_attr($term->term_id) . "'>" . esc_html($term->name) . "</a>
                          </li>";
                }
			}
		?>
	</ul>
</div>









