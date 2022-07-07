<?php

    echo '<div id="post-entry" class="post-entry '. $post_layout .'">';

    while ($query->have_posts()) : $query->the_post();

	    global $post;

        // Get data
	    $post_id = get_the_ID();
	    $title   = get_the_title($post_id);
	    $link    = get_the_permalink($post_id);
	    $post_date_format = apply_filters('ymc_post_date_format', 'd, M Y');
	    $image_url = YMC_SMART_FILTER_URL . '/front/assets/images/dummy-Image.svg';
	    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
	    if( is_array($image) ) {
		  $image_url = $image[0];
        }

	    $content = $post->post_excerpt;
	    if( empty($content) ) {
		    $content = $post->post_content;
	    }

	    $content  = preg_replace('#\[[^\]]+\]#', '', $content);
	    $c_length = apply_filters('ymc_post_excerpt_length', 30);
	    $content  = wp_trim_words($content, $c_length);

	    $read_more = apply_filters('ymc_post_read_more', 'Read More');


        echo '<article id="'. $post_layout .'" class="ymc-post-layout1 ymc-col" data-post-id="'. esc_attr(get_the_id()) .'">';
        echo '<figure class="media"><img src="'. $image_url .'"></figure>';
        echo '<header class="title">'. esc_attr($title) .'</header>';
        echo '<div class="date"><i class="far fa-calendar-alt"></i> '. get_the_date($post_date_format) . '</div>';
        echo '<div class="excerpt">'. $content .'</div>';
        echo '<div class="read-more"><a class="btn btn-read-more" href="'. esc_url($link) .'">'. esc_html($read_more) .'</a></div>';
        echo '</article>';

    endwhile;

    echo '</div>';

?>

