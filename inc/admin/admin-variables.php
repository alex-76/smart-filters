<?php

global $post;
$args = array( 'public' => true,  );
$output = 'names';

$cpost_types = get_post_types( $args, $output );
$pos = array_search('attachment', $cpost_types);
unset($cpost_types[$pos]);
$pos = array_search('popup', $cpost_types);
unset($cpost_types[$pos]);
$pos = array_search('post', $cpost_types);
unset($cpost_types[$pos]);
$pos = array_search('product', $cpost_types);
unset($cpost_types[$pos]);
ksort( $cpost_types, SORT_ASC );

// GENERAL TAB USED DEFAULT VARIABLES
$cpt = 'post';
$tax = 'category';
$tax_sel = array();
$terms_sel = array();

// LAYOUT TAB USED DEFAULT VARIABLES
$ymc_filter_status = 'on';
$ymc_filter_layout = 'filter-layout1';
$ymc_filter_text_color = '#000';
$ymc_filter_bg_color = '#098ab8';
$ymc_filter_active_color = '#e91e63';
$ymc_post_layout = 'post-layout1';
$ymc_col_options = [
	"ymc_col_desktop" => '4',
	"ymc_col_tablet" => '2',
	"ymc_col_mobile" => '1'
];




// GENERAL TAB SUBMITTED VARIABLE VALUES
if( get_post_meta($post->ID, 'ymc_cpt_value') ) {
	$cpt = get_post_meta($post->ID, 'ymc_cpt_value', true);
}
if( get_post_meta($post->ID, 'ymc_taxonomy') ) {
	$tax_sel = get_post_meta($post->ID, 'ymc_taxonomy', true);
}
if( get_post_meta($post->ID, 'ymc_terms') ) {
	$terms_sel = get_post_meta($post->ID, 'ymc_terms', true);
}

// LAYOUTS TAB SUBMITTED VARIABLE VALUES
if( get_post_meta($post->ID, 'ymc_filter_status') ) {
	$ymc_filter_status = get_post_meta($post->ID, 'ymc_filter_status', true);
}
if( get_post_meta($post->ID, 'ymc_filter_layout') ) {
	$ymc_filter_layout = get_post_meta($post->ID, 'ymc_filter_layout', true);
}
if( get_post_meta($post->ID, 'ymc_filter_text_color', true) ) {
	$ymc_filter_text_color = get_post_meta($post->ID, 'ymc_filter_text_color', true);
}
if( get_post_meta($post->ID, 'ymc_filter_bg_color', true) ) {
	$ymc_filter_bg_color = get_post_meta($post->ID, 'ymc_filter_bg_color', true);
}
if( get_post_meta($post->ID, 'ymc_filter_active_color', true) ) {
	$ymc_filter_active_color = get_post_meta($post->ID, 'ymc_filter_active_color', true);
}
if( get_post_meta($post->ID, 'ymc_post_layout') ) {
	$ymc_post_layout = get_post_meta($post->ID, 'ymc_post_layout', true);
}
if (get_post_meta($post->ID, 'ymc_col_options')) {
	$ymc_col_options = get_post_meta( $post->ID, 'ymc_col_options', true );
}

