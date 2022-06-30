<?php

// DEFAULTS VALUES

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

/*---- GENERAL TAB USED DEFAULT VARIABLES ----*/
$select = 'post';
$tax = 'category';
$tax_sel = array();
$terms_sel = array();

/*---- GENERAL TAB SUBMITTED VARIABLE VALUES ----*/
if(get_post_meta($post->ID, 'ymc_cpt_value')) {
	$select = get_post_meta($post->ID, 'ymc_cpt_value', true);
}
if(get_post_meta($post->ID, 'ymc_taxonomy')) {
	$tax_sel = get_post_meta($post->ID, 'ymc_taxonomy', true);
}
if(get_post_meta($post->ID, 'ymc_terms')) {
	$terms_sel = get_post_meta($post->ID, 'ymc_terms', true);
}