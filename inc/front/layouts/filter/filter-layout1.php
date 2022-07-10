<?php
    defined('ABSPATH') or exit;
    // Add Style

$ymc_filter_text_color = !empty($ymc_filter_text_color) ? "color:".$ymc_filter_text_color.";" : '';
$ymc_filter_bg_color   = !empty($ymc_filter_bg_color) ? "background-color:".$ymc_filter_bg_color.";" : '';
$ymc_filter_active_color = !empty($ymc_filter_active_color) ? "color:".$ymc_filter_active_color.";" : '';

$filter_css = ".ymc-smart-filter-container .filter-layout.filter-layout1 .filter-entry .filter-item .filter-link {". $ymc_filter_text_color . $ymc_filter_bg_color."}
               #ymc-smart-filter-container .filter-layout.filter-layout1 .filter-entry .filter-item .filter-link.active {".$ymc_filter_active_color."}";
    wp_add_inline_style($handle, $filter_css);
?>

<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

    <ul class="filter-entry">

		<?php

            $type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

            if ( is_array($terms_selected) ) {

	            ( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected);

                echo '<li class="filter-item"><a class="filter-link all active" href="#" data-id="' . esc_attr($terms) . '">' . __("All",'ymc-smart-filter') . '</a></li>';

                foreach ($terms_selected as $term) {

                    echo "<li class='filter-item'>
                            <a class='filter-link ".$type_multiple."' href='#' data-termid='" . esc_attr($term) . "'>" . esc_html(get_term( $term )->name) . "</a>
                          </li>";
                }
            }
		?>

	</ul>

    <?php do_action("ymc_after_filter_layout"); ?>

</div>









