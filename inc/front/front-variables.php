<?php
// DEFAULT VALUES
$ymc_post_layout   = 'post-layout1';
$ymc_filter_layout = 'filter-layout1';



// APPEARANCE TAB SUBMITTED VARIABLE VALUES
if (get_post_meta($id, 'ymc_post_layout', true)) {
	$ymc_post_layout = get_post_meta($id, 'ymc_post_layout', true);
}



