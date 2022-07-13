<?php
defined('ABSPATH') or exit;

// Add Style


$filter_css = "";
wp_add_inline_style($handle, $filter_css);
?>


<div id="<?php echo $ymc_filter_layout; ?>" class="filter-layout <?php echo $ymc_filter_layout; ?>">

	<ul class="filter-entry">

		<?php

		$type_multiple = ( (bool) $ymc_multiple_filter ) ? 'multiple' : '';

		if ( is_array($terms_selected) ) {

			( $ymc_sort_terms === 'asc' ) ? asort($terms_selected) : arsort($terms_selected); ?>

            <?php //var_dump($terms_selected);?>

            Filter Dropdown

        <?php } ?>

	</ul>

	<?php do_action("ymc_after_filter_layout"); ?>

</div>
