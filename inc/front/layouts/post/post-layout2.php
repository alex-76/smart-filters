

<?php

    while ($query->have_posts()) : $query->the_post();

        echo '<article class="ymc-'.$post_layout.' ymc-col" data-post-id="'. esc_attr(get_the_id()) .'">
                <h2 style="font-size: 28px;">Layout 2 ' . get_the_title(get_the_ID()) .' '. get_post_meta($filter_id, 'ymc_post_layout', true) .'</h2>
                <p>'.wp_trim_words(get_the_content(get_the_ID()), 25).'</p>
                <a href="#">More...</a>
             </article>';

    endwhile;

?>


