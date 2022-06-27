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

