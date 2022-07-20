<?php
defined('ABSPATH') or exit;

// Add Style


$filter_css = "";
wp_add_inline_style($handle, $filter_css);
?>


<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

	<?php do_action("ymc_before_filter_layout"); ?>

	<?php if( is_array($terms_selected) ) :

		$all_terms = implode(',', $terms_selected);
    ?>

    <div class="filter-entry" data-terms="<?php echo $all_terms; ?>">

		<?php

		$type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

        ( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected); ?>

        <?php

            $arr_taxonomies = [];

            foreach ($terms_selected as $term) {

                $arr_taxonomies[] = get_term( $term )->taxonomy;
            }
            $arr_taxonomies = array_unique($arr_taxonomies);

            $show_all = apply_filters('ymc_button_show_all', 'Show All');

            echo '<a class="btn-all" href="#" data-selected="all" data-terms="' . $all_terms . '">'. $show_all .'</a>';

            foreach ($arr_taxonomies as $tax) {

	            $select_term = apply_filters('ymc_select_term_dropdown', $tax);

                echo '<div class="dropdown-filter">';
                echo '<div class="menu-active">';
                echo '<span>'.$select_term.'</span> <i class="arrow down"></i>';
                echo '</div>';
                echo '<div class="menu-passive">';
                echo '<i class="btn-close">x</i>';

                foreach ($terms_selected as $term) {

                    if( $tax === get_term( $term )->taxonomy ) {

                     $is_disabled = ( get_term( $term )->count === 0 ) ? 'isDisabled' : '';


                        echo '<div class="menu-passive__item">
                                  <a class="menu-link '. $is_disabled .' '. $type_multiple .'" 
                                  href="#" data-selected="'.esc_attr(get_term( $term )->slug).'" data-termid="' . esc_attr($term) . '" data-name="'.esc_attr(get_term( $term )->name).'">'.
                                  esc_html(get_term( $term )->name) . ' <span class="count">(' .esc_html(get_term( $term )->count) . ')</span>'.
                             '</a></div>';

                    }


                }

                echo '</div>';
                echo '</div>';
            }

        ?>

        <div class="selected-items"></div>

	</div>

    <div class="posts-found"></div>

    <?php endif; ?>

	<?php do_action("ymc_after_filter_layout"); ?>

</div>
