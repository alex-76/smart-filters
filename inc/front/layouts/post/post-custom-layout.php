<?php

// Custom Post Layout

$layouts = '';

while ($query->have_posts()) : $query->the_post();

	$layouts .= '<article class="ymc-'.$post_layout.' post-'.get_the_id().' post-item '.$css_special.'">';
	$layouts .= '<header class="head-post">'.esc_html__('Add your custom layout.','ymc-smart-filter').'</header>';
	$layouts .= '<div class="inform">'.esc_html__('Use a filter:','ymc-smart-filter').' 
                 <span class="doc-text">ymc_post_custom_layout</span> 
                 '.esc_html__('to override post template.','ymc-smart-filter').' <br>'.esc_html__('Example:','ymc-smart-filter').'
                 <span class="doc-text">add_filter("ymc_post_custom_layout", "func_cpt_layout", 10, 3);</span></div>';
	$layouts .= '</article>';

endwhile;

echo apply_filters('ymc_post_custom_layout', $layouts, get_the_ID(), $filter_id );


