<?php
defined('ABSPATH') or exit;

// Add Style


$filter_css = "";
wp_add_inline_style($handle, $filter_css);
?>


<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

	<div class="filter-entry">

		<?php

		$type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

		if ( is_array($terms_selected) ) {

			( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected); ?>

            <div class="dropdown-filter">
                <div class="menu-active">
                    Filter Dropdown
                    <i class="arrow down"></i>
                </div>
                <div class="menu-passive">
                    <div class="menu-passive__item"><a class="menu-link" href="#">Item 1</a></div>
                    <div class="menu-passive__item"><a class="menu-link" href="#">Item 1</a></div>
                    <div class="menu-passive__item"><a class="menu-link" href="#">Item 1</a></div>
                </div>



            </div>

            <?php //var_dump($terms_selected);?>

        <?php } ?>

	</div>

	<?php do_action("ymc_after_filter_layout"); ?>

</div>
