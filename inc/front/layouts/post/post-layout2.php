

<?php

    while ($query->have_posts()) : $query->the_post();

        echo '<article class="ymc-'.$post_layout.' post-'.get_the_id().' post-item">
                <h2>' . get_the_title(get_the_ID()) .'</h2>
                <p>'.wp_trim_words(get_the_content(get_the_ID()), 25).'</p>
                <a href="#">More...</a>
             </article>';

    endwhile;

?>


