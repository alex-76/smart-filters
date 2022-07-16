<?php
defined('ABSPATH') or exit;

// Add Style


$filter_css = "";
wp_add_inline_style($handle, $filter_css);
?>


<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

	<?php do_action("ymc_before_filter_layout"); ?>

	<div class="filter-entry">

		<?php

		$type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

		if ( is_array($terms_selected) ) {

			( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected); ?>

            <?php

                $arr_taxonomies = [];
                foreach ($terms_selected as $term) {

                    $arr_taxonomies[] = get_term( $term )->taxonomy;
                }
                $arr_taxonomies = array_unique($arr_taxonomies);

                foreach ($arr_taxonomies as $tax) {

                    echo '<div class="dropdown-filter">';
                    echo '<div class="menu-active">';
                    echo 'Select '.$tax.' <i class="arrow down"></i>';
                    echo '</div>';
                    echo '<div class="menu-passive">';

	                foreach ($terms_selected as $term) {

		                if( $tax === get_term( $term )->taxonomy ) {
                            echo '<div class="menu-passive__item"><a class="menu-link '. $type_multiple .'" href="#" data-termid="' . esc_attr($term) . '">'. esc_html(get_term( $term )->name) .'</a></div>';
		                }
	                }

                    echo '</div>';
                    echo '</div>';
                }

            ?>

        <?php } ?>

	</div>

	<?php do_action("ymc_after_filter_layout"); ?>

</div>
