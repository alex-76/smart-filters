

<?php

while ($query->have_posts()) : $query->the_post();

	echo '<article class="ymc-'.$post_layout.' post-'.get_the_id().' post-item">';

	echo apply_filters('ymc_post_custom_layout', $layouts, get_the_ID(), $filter_id );

	echo '</article>';

endwhile;

?>


