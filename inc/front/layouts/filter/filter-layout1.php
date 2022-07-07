<?php
    defined('ABSPATH') or exit;
    // Add Style
    $filter_css = "#ymc-smart-container .filter-layout1 .filter-entry .filter-item .filter-link {color:".$ymc_filter_text_color.";background-color:".$ymc_filter_bg_color.";}
                   #ymc-smart-container .filter-layout1 .filter-entry .filter-item .filter-link.active {color:".$ymc_filter_active_color.";}";
    wp_add_inline_style($handle, $filter_css);
?>

<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">
	<ul class="filter-entry">
		<?php

			if ( $terms_selected ) {

				echo '<li class="filter-item"><a class="filter-link active" href="#" data-id="' . esc_attr($terms) . '">' . __("All",'ymc-smart-filter') . '</a></li>';

                foreach ($terms_selected as $term) {
                    echo "<li class='filter-item'>
                          <a class='filter-link' href='#' data-id='" . esc_attr($term) . "'>" . esc_html(get_term( $term )->name) . "</a>
                          </li>";
                }
			}
		?>
	</ul>
</div>









