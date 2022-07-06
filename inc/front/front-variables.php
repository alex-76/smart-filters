<?php
// DEFAULT VALUES
$ymc_cpt_value = 'post';
$tax = 'category';
$term = '';
$ymc_post_layout = 'post-layout1';
$ymc_filter_layout = 'filter-layout1';


// APPEARANCE TAB SUBMITTED VARIABLE VALUES
if(get_post_meta($id, 'ymc_cpt_value', true)) {
	$ymc_cpt_value = get_post_meta($id,'ymc_cpt_value', true);
}
if (get_post_meta($id, 'ymc_taxonomy')) {
	$tax_selected = get_post_meta($id, 'ymc_taxonomy', true);
}
if (get_post_meta($id, 'ymc_terms')) {
	$terms_selected = get_post_meta($id, 'ymc_terms', true);
}
if (get_post_meta($id, 'ymc_filter_status', true)) {
	$ymc_filter_status = get_post_meta($id, 'ymc_filter_status', true);
}
if (get_post_meta($id, 'ymc_filter_layout', true)) {
	$ymc_filter_layout = get_post_meta($id, 'ymc_filter_layout', true);
}
if (get_post_meta($id, 'ymc_post_layout', true)) {
	$ymc_post_layout = get_post_meta($id, 'ymc_post_layout', true);
}
if (get_post_meta($id, 'ymc_filter_text_color', true)) {
	$ymc_filter_text_color = get_post_meta($id, 'ymc_filter_text_color', true);
}
if (get_post_meta($id, 'ymc_filter_bg_color', true)) {
	$ymc_filter_bg_color = get_post_meta($id, 'ymc_filter_bg_color', true);
}
if (get_post_meta($id, 'ymc_filter_active_color', true)) {
	$ymc_filter_active_color = get_post_meta($id, 'ymc_filter_active_color', true);
}



